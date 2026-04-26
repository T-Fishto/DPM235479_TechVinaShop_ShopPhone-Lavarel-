<?php

namespace App\Http\Controllers\Admin;

use App\Models\LoaiSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use app\Http\Controllers\Controller;

class LoaiSanPhamController extends Controller
{
    public function index()
    {
        $loaisanpham = LoaiSanPham::all();
        return view('admin.loaisanpham.index', compact('loaisanpham'));
    }

    public function getThem()
    {
        return view('admin.loaisanpham.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tenloai' => ['required', 'string', 'max:191', 'unique:loaisanpham,tenloai'],
        ]);

        $orm = new LoaiSanPham();
        $orm->tenloai      = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->mota         = $request->mota;
        $orm->save();

        return redirect()->route('admin.loaisanpham');
    
    }

    public function getSua($id)
    {
        $loaisanpham = LoaiSanPham::findOrFail($id);
        return view('admin.loaisanpham.sua', compact('loaisanpham'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenloai' => ['required', 'string', 'max:191', 'unique:loaisanpham,tenloai,' . $id],
        ]);

        $orm = LoaiSanPham::findOrFail($id);
        $orm->tenloai      = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->mota         = $request->mota;
        $orm->save();

        return redirect()->route('admin.loaisanpham');
                         
    }

    public function getXoa($id)
    {
        LoaiSanPham::findOrFail($id)->delete();
        return redirect()->route('admin.loaisanpham');
                         
    }
}