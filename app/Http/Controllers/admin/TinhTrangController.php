<?php

namespace App\Http\Controllers\admin;

use App\Models\TinhTrang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TinhTrangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tinhtrang = TinhTrang::all();
        return view('admin.tinhtrang.index', compact('tinhtrang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tinhtrang.them');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'tinhtrang' => ['required', 'string', 'max:191', 'unique:tinhtrang'],
        ]);

        $orm = new TinhTrang();
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();

        return redirect()->route('admin.tinhtrang')->with('status', 'Thêm tình trạng thành công!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(TinhTrang $tinhTrang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tinhtrang = TinhTrang::findOrFail($id);
        return view('admin.tinhtrang.sua', compact('tinhtrang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tinhtrang' => ['required', 'string', 'max:191', 'unique:tinhtrang,tinhtrang,' . $id],
        ]);

        $orm = TinhTrang::findOrFail($id);
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();

        return redirect()->route('admin.tinhtrang')->with('status', 'Cập nhật tình trạng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orm = TinhTrang::findOrFail($id);
        $orm->delete();

        return redirect()->route('admin.tinhtrang')->with('status', 'Xóa tình trạng thành công!');
    }
}
