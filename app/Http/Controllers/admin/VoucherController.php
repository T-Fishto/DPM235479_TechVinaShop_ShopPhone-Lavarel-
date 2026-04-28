<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    // Danh sách voucher
    public function index()
    {
        $vouchers = Voucher::orderBy('created_at', 'desc')->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    // Form thêm mới
    public function create()
    {
        return view('admin.voucher.them');
    }

    // Xử lý thêm mới
    public function store(Request $request)
    {
        $request->validate([
            'ma_giam_gia'          => 'required|string|max:50|unique:vouchers,ma_giam_gia',
            'ten_voucher'          => 'required|string|max:255',
            'loai_giam'            => 'required|in:percent,fixed',
            'gia_tri_giam'         => 'required|numeric|min:1',
            'giam_toi_da'          => 'nullable|numeric|min:0',
            'don_hang_toi_thieu'   => 'nullable|numeric|min:0',
            'so_lan_su_dung_toi_da'=> 'nullable|integer|min:1',
            'ngay_bat_dau'         => 'nullable|date',
            'ngay_het_han'         => 'nullable|date|after_or_equal:ngay_bat_dau',
        ], [
            'ma_giam_gia.unique'   => 'Mã giảm giá này đã tồn tại.',
            'loai_giam.in'         => 'Loại giảm không hợp lệ.',
            'gia_tri_giam.min'     => 'Giá trị giảm phải lớn hơn 0.',
            'ngay_het_han.after_or_equal' => 'Ngày hết hạn phải sau ngày bắt đầu.',
        ]);

        // Nếu giảm theo %, giá trị không được vượt 100
        if ($request->loai_giam === 'percent' && $request->gia_tri_giam > 100) {
            return back()->withErrors(['gia_tri_giam' => 'Phần trăm giảm không được vượt quá 100%.'])->withInput();
        }

        Voucher::create([
            'ma_giam_gia'           => strtoupper(trim($request->ma_giam_gia)),
            'ten_voucher'           => $request->ten_voucher,
            'loai_giam'             => $request->loai_giam,
            'gia_tri_giam'          => $request->gia_tri_giam,
            'giam_toi_da'           => $request->giam_toi_da ?? 0,
            'don_hang_toi_thieu'    => $request->don_hang_toi_thieu ?? 0,
            'so_lan_su_dung_toi_da' => $request->so_lan_su_dung_toi_da ?? null,
            'so_lan_da_su_dung'     => 0,
            'ngay_bat_dau'          => $request->ngay_bat_dau,
            'ngay_het_han'          => $request->ngay_het_han,
            'kichhoat'              => $request->has('kichhoat') ? 1 : 0,
        ]);

        return redirect()->route('admin.voucher')->with('status', 'Thêm mã giảm giá thành công!');
    }

    // Form sửa
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.sua', compact('voucher'));
    }

    // Xử lý sửa
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'ma_giam_gia'          => 'required|string|max:50|unique:vouchers,ma_giam_gia,' . $id,
            'ten_voucher'          => 'required|string|max:255',
            'loai_giam'            => 'required|in:percent,fixed',
            'gia_tri_giam'         => 'required|numeric|min:1',
            'giam_toi_da'          => 'nullable|numeric|min:0',
            'don_hang_toi_thieu'   => 'nullable|numeric|min:0',
            'so_lan_su_dung_toi_da'=> 'nullable|integer|min:1',
            'ngay_bat_dau'         => 'nullable|date',
            'ngay_het_han'         => 'nullable|date|after_or_equal:ngay_bat_dau',
        ]);

        if ($request->loai_giam === 'percent' && $request->gia_tri_giam > 100) {
            return back()->withErrors(['gia_tri_giam' => 'Phần trăm giảm không được vượt quá 100%.'])->withInput();
        }

        $voucher->update([
            'ma_giam_gia'           => strtoupper(trim($request->ma_giam_gia)),
            'ten_voucher'           => $request->ten_voucher,
            'loai_giam'             => $request->loai_giam,
            'gia_tri_giam'          => $request->gia_tri_giam,
            'giam_toi_da'           => $request->giam_toi_da ?? 0,
            'don_hang_toi_thieu'    => $request->don_hang_toi_thieu ?? 0,
            'so_lan_su_dung_toi_da' => $request->so_lan_su_dung_toi_da ?? null,
            'ngay_bat_dau'          => $request->ngay_bat_dau,
            'ngay_het_han'          => $request->ngay_het_han,
            'kichhoat'              => $request->has('kichhoat') ? 1 : 0,
        ]);

        return redirect()->route('admin.voucher')->with('status', 'Cập nhật mã giảm giá thành công!');
    }

    // Xóa voucher
    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();
        return redirect()->route('admin.voucher')->with('status', 'Đã xóa mã giảm giá!');
    }

    // Bật / Tắt kích hoạt
    public function kichhoat($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->kichhoat = !$voucher->kichhoat;
        $voucher->save();
        return redirect()->route('admin.voucher')->with('status', 'Đã cập nhật trạng thái mã giảm giá!');
    }
}
