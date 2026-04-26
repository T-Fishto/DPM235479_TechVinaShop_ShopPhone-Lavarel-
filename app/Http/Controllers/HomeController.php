<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use App\Models\ChuDe;
use App\Models\BaiViet;
use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Mail\DatHangThanhCongEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    // Hàm hiển thị trang chủ cho khách hàng
    public function getHome()
    {
        // Lấy danh sách sản phẩm nổi bật (ví dụ lấy 8 cái mới nhất)
        $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])->latest()->take(8)->get();
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();

        return view('frontend.home', compact('sanpham', 'loaisanpham', 'hangsanxuat')); 
    }
    public function getSanPham($tenloai_slug = '')
    {
        // Lấy tất cả loại sản phẩm và hãng sản xuất cho bộ lọc/sidebar
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();

        if (empty($tenloai_slug)) {
            // Nếu không có slug, hiển thị tất cả sản phẩm
            $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])->paginate(12);
            $tenLoai = 'Tất cả sản phẩm';
        } else {
            // Nếu có slug, lọc theo loại sản phẩm
            $loai = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->firstOrFail();
            $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])
                ->where('loaisanpham_id', $loai->id)
                ->paginate(12);
            $tenLoai = $loai->tenloai;
        }

        return view('frontend.sanpham', compact('sanpham', 'loaisanpham', 'hangsanxuat', 'tenLoai'));
    }
    public function getSanPham_ChiTiet($tenloai_slug = '', $tensanpham_slug = '')
    {
        // Lấy sản phẩm dựa trên slug kèm theo các đánh giá đã duyệt
        $sanpham = SanPham::with(['DanhGia' => function($query) {
            $query->where('kichhoat', 1)->orderBy('created_at', 'desc');
        }, 'DanhGia.User'])->where('tensanpham_slug', $tensanpham_slug)->firstOrFail();
        
        // Lấy các sản phẩm cùng loại
        $sanphamCungLoai = SanPham::where('loaisanpham_id', $sanpham->loaisanpham_id)
            ->where('id', '!=', $sanpham->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
            
        return view('frontend.sanpham_chitiet', compact('sanpham', 'sanphamCungLoai'));
    }

    public function getThuongHieu($tenhang_slug = '')
    {
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();

        if (empty($tenhang_slug)) {
            $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])->paginate(12);
            $tenHang = 'Tất cả thương hiệu';
        } else {
            $hang = HangSanXuat::where('tenhang_slug', $tenhang_slug)->firstOrFail();
            $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])
                ->where('hangsanxuat_id', $hang->id)
                ->paginate(12);
            $tenHang = $hang->tenhang;
        }

        return view('frontend.thuonghieu', compact('sanpham', 'loaisanpham', 'hangsanxuat', 'tenHang'));
    }
    public function getBaiViet($tenchude_slug = '')
    {
        $chude = ChuDe::all();
        if(empty($tenchude_slug))
        {
            $baiviet = BaiViet::with(['ChuDe', 'User'])->where('kichhoat', 1)->orderBy('created_at', 'desc')->paginate(12);
            $tenChuDe = 'Tất cả bài viết';
        }
        else
        {
            $cd = ChuDe::where('tenchude_slug', $tenchude_slug)->firstOrFail();
            $baiviet = BaiViet::with(['ChuDe', 'User'])->where('kichhoat', 1)
                ->where('chude_id', $cd->id)
                ->orderBy('created_at', 'desc')
                ->paginate(12);
            $tenChuDe = $cd->tenchude;
        }
        return view('frontend.baiviet', compact('baiviet', 'chude', 'tenChuDe'));
    }

    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')  
    {
        $baiviet = BaiViet::with(['ChuDe', 'User'])->where('tieude_slug', $tieude_slug)->firstOrFail();
        
        // Tăng lượt xem
        $baiviet->increment('luotxem');
        
        $baivietCungChude = BaiViet::where('kichhoat', 1)
            ->where('chude_id', $baiviet->chude_id)
            ->where('id', '!=', $baiviet->id)
            ->take(3)
            ->get();
            
        return view('frontend.baiviet_chitiet', compact('baiviet', 'baivietCungChude'));
    }
    public function getTimKiem(Request $request)
    {
        $tuKhoa = $request->input('tu-khoa');
        $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])
            ->where('tensanpham', 'LIKE', "%$tuKhoa%")
            ->paginate(12);
        
        return view('frontend.timkiem', compact('sanpham', 'tuKhoa'));
    }

    public function getTimKiemGoiY(Request $request)
    {
        $tuKhoa = $request->input('tu-khoa');
        if (empty($tuKhoa)) {
            return response()->json([]);
        }

        $sanpham = SanPham::with('LoaiSanPham')
            ->where('tensanpham', 'LIKE', "%$tuKhoa%")
            ->take(5)
            ->get();

        $goiY = $sanpham->map(function($item) {
            return [
                'tensanpham' => $item->tensanpham,
                'hinhanh' => asset('uploads/sanpham/' . $item->hinhanh),
                'dongia' => number_format($item->dongia, 0, ',', '.') . ' VNĐ',
                'url' => route('frontend.sanpham.chitiet', [
                    'tenloai_slug' => $item->LoaiSanPham->tenloai_slug ?? 'san-pham',
                    'tensanpham_slug' => $item->tensanpham_slug
                ])
            ];
        });

        return response()->json($goiY);
    }

    public function getTuyenDung()
    {
        return view('frontend.tuyendung');
    }

    public function getLienHe()
    { 
        return view('frontend.lienhe');
    }
    // Hàm 1: Đưa khách qua trang chọn tài khoản Google
    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // Hàm 2: Xử lý dữ liệu khi Google trả về
    public function getGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('warning', 'Lỗi kết nối với Google. Xin vui lòng thử lại!');
        }

        // Kiểm tra xem email này đã đăng ký trong web mình chưa
        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            // Nếu đã có tài khoản -> Cho đăng nhập luôn
            Auth::login($existingUser, true);
        } else {
            // Nếu chưa có -> Tự động tạo tài khoản mới cho khách
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'username' => Str::before($googleUser->email, '@'), // Tự tạo username từ email (giống code của Thầy)
                'password' => Hash::make('TechVinaShop@123'), // Mật khẩu mặc định
                'role' => 'user', 
                'kichhoat' => 1
            ]);
            Auth::login($newUser, true);
        }

        // Đăng nhập xong thì chuyển về trang hồ sơ khách hàng
        return redirect()->route('user.home')->with('success', 'Đăng nhập thành công!');
    }



}
