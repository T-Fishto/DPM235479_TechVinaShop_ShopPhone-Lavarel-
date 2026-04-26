<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ChuDe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChuDeController extends Controller
{
    public function index()
    {
        $chude = ChuDe::all();
        return view('admin.chude.index', compact('chude'));
    }

    public function create()
    {
        return view('admin.chude.them');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenchude' => 'required|string|max:255|unique:chude,tenchude',
        ]);

        $chude = new ChuDe();
        $chude->tenchude = $request->tenchude;
        $chude->tenchude_slug = Str::slug($request->tenchude, '-');
        $chude->save();

        return redirect()->route('admin.chude')->with('status', 'Thêm chủ đề thành công!');
    }

    public function edit($id)
    {
        $chude = ChuDe::findOrFail($id);
        return view('admin.chude.sua', compact('chude'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tenchude' => 'required|string|max:255|unique:chude,tenchude,' . $id,
        ]);

        $chude = ChuDe::findOrFail($id);
        $chude->tenchude = $request->tenchude;
        $chude->tenchude_slug = Str::slug($request->tenchude, '-');
        $chude->save();

        return redirect()->route('admin.chude')->with('status', 'Cập nhật chủ đề thành công!');
    }

    public function destroy($id)
    {
        $chude = ChuDe::findOrFail($id);
        $chude->delete();

        return redirect()->route('admin.chude')->with('status', 'Xóa chủ đề thành công!');
    }
}
