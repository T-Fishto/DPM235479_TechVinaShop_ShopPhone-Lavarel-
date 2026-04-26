<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getHome()
    {
        $soSanPham = \App\Models\SanPham::count();
        $soDonHang = \App\Models\DonHang::count();
        $soNguoiDung = \App\Models\User::count();
        $soBaiViet = \App\Models\BaiViet::count();
        
        $donHangMoi = \App\Models\DonHang::with(['User', 'TinhTrang'])->orderBy('created_at', 'desc')->take(5)->get();

        // Thống kê trạng thái đơn hàng cho biểu đồ
        $thongKeDonHang = [
            'moi_dat' => \App\Models\DonHang::where('tinhtrang_id', 1)->count(),
            'dang_xu_ly' => \App\Models\DonHang::where('tinhtrang_id', 2)->count(),
            'da_huy' => \App\Models\DonHang::where('tinhtrang_id', 4)->count(),
            'hoan_thanh' => \App\Models\DonHang::where('tinhtrang_id', 3)->count(),
        ];

        return view('admin.home', compact('soSanPham', 'soDonHang', 'soNguoiDung', 'soBaiViet', 'donHangMoi', 'thongKeDonHang'));
    }

    public function getHoSoCaNhan()
    {
        $nguoidung = \Illuminate\Support\Facades\Auth::user();
        return view('admin.hosocanhan', compact('nguoidung'));
    }

    public function postHoSoCaNhan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . \Illuminate\Support\Facades\Auth::id(),
            'dienthoai' => 'nullable|string|max:20',
            'diachi' => 'nullable|string',
            'hinhanh' => 'nullable|image|max:2048'
        ]);

        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
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

        return redirect()->route('admin.hosocanhan')->with('status', 'Cập nhật hồ sơ thành công!');
    }
}
