<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use Illuminate\Http\Request;

class DanhGiaSPController extends Controller
{
    public function index()
    {
        $danhgia = DanhGia::with(['User', 'SanPham'])->orderBy('created_at', 'desc')->get();
        return view('admin.danhgia.index', compact('danhgia'));
    }

    public function destroy($id)
    {
        $danhgia = DanhGia::findOrFail($id);
        $danhgia->delete();

        return redirect()->route('admin.danhgia')->with('status', 'Xóa đánh giá thành công!');
    }

    public function kichhoat($id)
    {
        $danhgia = DanhGia::findOrFail($id);
        $danhgia->kichhoat = 1 - $danhgia->kichhoat;
        $danhgia->save();

        return redirect()->route('admin.danhgia')->with('status', 'Cập nhật trạng thái hiển thị thành công!');
    }

    public function duyet($id)
    {
        $danhgia = DanhGia::findOrFail($id);
        $danhgia->kichhoat = 1; // Duyệt là hiện luôn
        $danhgia->save();

        return redirect()->route('admin.danhgia')->with('status', 'Duyệt đánh giá thành công!');
    }
}
