<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Voucher;

class KhachHangController extends Controller
{
    public function getHome()
    {
        return redirect()->route('frontend.home');
    }
    public function getDatHang()
    {
        $nguoidung = Auth::user();
        return view('user.dathang', compact('nguoidung'));
    }
    public function postDathang(Request $request)
    {
        $request->validate([
            'dienthoai' => 'required|string|max:20',
            'diachi'    => 'required|string',
            'cart_data' => 'required|string',
        ]);

        $cart = json_decode($request->cart_data, true);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Xử lý voucher nếu có
        $soTienGiam   = 0;
        $maGiamGia    = null;
        $tongTienGoc  = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($request->filled('ma_giam_gia')) {
            $voucher = Voucher::where('ma_giam_gia', strtoupper(trim($request->ma_giam_gia)))->first();
            if ($voucher) {
                $kiemTra = $voucher->isHopLe($tongTienGoc);
                if ($kiemTra['hop_le']) {
                    $soTienGiam = $voucher->tinhSoTienGiam($tongTienGoc);
                    $maGiamGia  = $voucher->ma_giam_gia;
                } else {
                    return redirect()->back()->with('error', 'Mã giảm giá: ' . $kiemTra['thong_bao'])->withInput();
                }
            } else {
                return redirect()->back()->with('error', 'Mã giảm giá không tồn tại.')->withInput();
            }
        }

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($request, $cart, $soTienGiam, $maGiamGia) {
                // Tạo đơn hàng mới
                $donhang = new \App\Models\DonHang();
                $donhang->user_id              = \Illuminate\Support\Facades\Auth::id();
                $donhang->tinhtrang_id         = 1;
                $donhang->dienthoaigiaohang    = $request->dienthoai;
                $donhang->diachigiaohang       = $request->diachi;
                $donhang->phuongthucthanhtoan  = $request->phuongthuc;
                $donhang->ma_giam_gia          = $maGiamGia;
                $donhang->so_tien_giam         = $soTienGiam;
                $donhang->save();

                // Tạo chi tiết đơn hàng và trừ tồn kho
                foreach ($cart as $item) {
                    $sanpham = \App\Models\SanPham::lockForUpdate()->find($item['id']);
                    if (!$sanpham || $sanpham->soluong < $item['quantity']) {
                        throw new \Exception('Sản phẩm ' . ($sanpham ? $sanpham->tensanpham : 'không tồn tại') . ' không đủ số lượng trong kho.');
                    }

                    $chitiet = new \App\Models\DonHang_ChiTiet();
                    $chitiet->donhang_id = $donhang->id;
                    $chitiet->sanpham_id = $item['id'];
                    $chitiet->soluongban = $item['quantity'];
                    $chitiet->dongiaban = $item['price'];
                    $chitiet->save();

                    // Trừ số lượng tồn kho
                    $sanpham->soluong -= $item['quantity'];
                    $sanpham->save();
                }

                // Tăng số lần đã dùng của voucher
                if ($maGiamGia) {
                    \App\Models\Voucher::where('ma_giam_gia', $maGiamGia)
                        ->increment('so_lan_da_su_dung');
                }

                // Gửi email xác nhận
                if (\Illuminate\Support\Facades\Auth::user()?->email) {
                    \Illuminate\Support\Facades\Mail::to(\Illuminate\Support\Facades\Auth::user()->email)
                        ->send(new \App\Mail\DatHangThanhCongMail($donhang));
                }
            });
            return redirect()->route('user.DatHangThanhCong');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function getDatHangThanhCong()
    {
        return view('user.dathangthanhcong');
    }
    public function getDonHang($id='')
    {
        $donhang = \App\Models\DonHang::with('TinhTrang')->where('user_id', \Illuminate\Support\Facades\Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('user.donhang', compact('donhang'));
    }
    public function getHuyDonHang($id)
    {
        $donhang = \App\Models\DonHang::with('DonHang_ChiTiet.SanPham')->where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        
        // Chỉ cho phép hủy nếu đơn hàng đang ở trạng thái 'Mới đặt' (ID: 1)
        if ($donhang->tinhtrang_id == 1) {
            \Illuminate\Support\Facades\DB::transaction(function () use ($donhang) {
                $donhang->tinhtrang_id = 4; // Mã 4 là 'Đã hủy'
                $donhang->save();

                // Hoàn lại số lượng tồn kho
                foreach ($donhang->DonHang_ChiTiet as $chitiet) {
                    if ($chitiet->SanPham) {
                        $chitiet->SanPham->soluong += $chitiet->soluongban;
                        $chitiet->SanPham->save();
                    }
                }
            });
            return redirect()->route('user.donhang')->with('status', 'Đã hủy đơn hàng thành công.');
        }
        
        return redirect()->route('user.donhang')->with('error', 'Không thể hủy đơn hàng này.');
    }
    public function getDonHang_ChiTiet($id='')
    {
        // Sử dụng Model DonHang và DonHang_ChiTiet bạn đã tạo sẵn
        $donhang = \App\Models\DonHang::with('TinhTrang')->where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        $donhang_chitiet = \App\Models\DonHang_ChiTiet::with('SanPham')->where('donhang_id', $donhang->id)->get();
        
        return view('user.donhang_chitiet', compact('donhang', 'donhang_chitiet'));
    }

    public function getHoSoCaNhan()
    {
        $nguoidung = Auth::user();
        return view('user.hosocanhan', compact('nguoidung'));
    }
    public function postHoSoCaNhan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'dienthoai' => 'nullable|string|max:20',
            'diachi' => 'nullable|string',
            'hinhanh' => 'nullable|image|max:2048'
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dienthoai = $request->dienthoai;
        $user->diachi = $request->diachi;

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $user->hinhanh = $filename;
        }

        $user->save();

        return redirect()->route('user.hosocanhan')->with('status', 'Cập nhật hồ sơ thành công!');
    }
    public function getDoiMatKhau()
    {
        return view('user.doimatkhau');
    }
    public function postDoiMatKhau(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed|different:old_password',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            'password.different' => 'Mật khẩu mới phải khác mật khẩu cũ.',
        ]);

        $user = User::find(Auth::id());

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác.']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        return redirect()->route('user.hosocanhan')->with('status', 'Đổi mật khẩu thành công!');
    }
    public function getDanhGiaSanPham($tensanpham_slug = '')
    {
        return view('user.danhgiasanpham');
    }
    public function postDanhGiaSanPham(Request $request, $tensanpham_slug = '')
    {
        $request->validate([
            'diem' => 'required|integer|min:1|max:5',
            'noidung' => 'required|string|max:1000',
        ]);

        $sanpham = \App\Models\SanPham::where('tensanpham_slug', $tensanpham_slug)->firstOrFail();

        $danhgia = new \App\Models\DanhGia();
        $danhgia->sanpham_id = $sanpham->id;
        $danhgia->user_id = \Illuminate\Support\Facades\Auth::id();
        $danhgia->diem = $request->diem;
        $danhgia->noidung = $request->noidung;
        $danhgia->kichhoat = 1; // Cho phép hiển thị ngay
        $danhgia->save();

        return redirect()->back()->with('status', 'Cảm ơn bạn đã gửi đánh giá cho sản phẩm!');
    }
   

    public function postTimDanhGia($id)
    {
        $danhgia = \App\Models\DanhGia::findOrFail($id);
        $user_id = Auth::id();

        $tim = \App\Models\DanhGiaTim::where('danhgia_id', $id)->where('user_id', $user_id)->first();

        if ($tim) {
            $tim->delete();
        } else {
            \App\Models\DanhGiaTim::create([
                'danhgia_id' => $id,
                'user_id'    => $user_id
            ]);
        }

        return redirect()->back();
    }

    /**
     * API kiểm tra và áp dụng mã giảm giá
     */
    public function postKiemTraVoucher(Request $request)
    {
        $request->validate([
            'ma_giam_gia' => 'required|string',
            'tong_tien'   => 'required|numeric|min:0',
        ]);

        $voucher = Voucher::where('ma_giam_gia', strtoupper(trim($request->ma_giam_gia)))->first();

        if (!$voucher) {
            return response()->json([
                'hop_le'    => false,
                'thong_bao' => 'Mã giảm giá không tồn tại.',
            ]);
        }

        $kiemTra = $voucher->isHopLe((int) $request->tong_tien);

        if (!$kiemTra['hop_le']) {
            return response()->json([
                'hop_le'    => false,
                'thong_bao' => $kiemTra['thong_bao'],
            ]);
        }

        $soTienGiam = $voucher->tinhSoTienGiam((int) $request->tong_tien);

        return response()->json([
            'hop_le'       => true,
            'thong_bao'    => 'Mã đã được áp dụng!',
            'ten_voucher'  => $voucher->ten_voucher,
            'so_tien_giam' => $soTienGiam,
            'so_tien_giam_format' => number_format($soTienGiam, 0, ',', '.') . 'đ',
        ]);
    }
}