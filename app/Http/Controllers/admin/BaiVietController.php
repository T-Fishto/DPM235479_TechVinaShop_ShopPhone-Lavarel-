<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\ChuDe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BaiVietController extends Controller
{
    public function index()
    {
        $baiviet = BaiViet::with(['ChuDe', 'User'])->orderBy('created_at', 'desc')->get();
        return view('admin.baiviet.index', compact('baiviet'));
    }

    public function create()
    {
        $chude = ChuDe::all();
        return view('admin.baiviet.them', compact('chude'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chude_id' => 'required',
            'tieude' => 'required|string|max:255',
            'noidung' => 'required',
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $baiviet = new BaiViet();
        $baiviet->chude_id = $request->chude_id;
        $baiviet->user_id = Auth::id();
        $baiviet->tieude = $request->tieude;
        $baiviet->tieude_slug = Str::slug($request->tieude, '-');
        $baiviet->tomtat = $request->tomtat;
        $baiviet->noidung = $request->noidung;
        
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/baiviet/', $filename);
            $baiviet->hinhanh = $filename;
        }

        $baiviet->save();

        return redirect()->route('admin.baiviet')->with('status', 'Thêm bài viết thành công!');
    }

    public function edit($id)
    {
        $baiviet = BaiViet::findOrFail($id);
        $chude = ChuDe::all();
        return view('admin.baiviet.sua', compact('baiviet', 'chude'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'chude_id' => 'required',
            'tieude' => 'required|string|max:255',
            'noidung' => 'required',
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $baiviet = BaiViet::findOrFail($id);
        $baiviet->chude_id = $request->chude_id;
        $baiviet->tieude = $request->tieude;
        $baiviet->tieude_slug = Str::slug($request->tieude, '-');
        $baiviet->tomtat = $request->tomtat;
        $baiviet->noidung = $request->noidung;

        if ($request->hasFile('hinhanh')) {
            $path = 'uploads/baiviet/' . $baiviet->hinhanh;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('hinhanh');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/baiviet/', $filename);
            $baiviet->hinhanh = $filename;
        }

        $baiviet->save();

        return redirect()->route('admin.baiviet')->with('status', 'Cập nhật bài viết thành công!');
    }

    public function destroy($id)
    {
        $baiviet = BaiViet::findOrFail($id);
        $path = 'uploads/baiviet/' . $baiviet->hinhanh;
        if (File::exists($path)) {
            File::delete($path);
        }
        $baiviet->delete();

        return redirect()->route('admin.baiviet')->with('status', 'Xóa bài viết thành công!');
    }

    public function kichhoat($id)
    {
        $baiviet = BaiViet::findOrFail($id);
        $baiviet->kichhoat = 1 - $baiviet->kichhoat;
        $baiviet->save();

        return redirect()->route('admin.baiviet')->with('status', 'Cập nhật trạng thái thành công!');
    }
}
