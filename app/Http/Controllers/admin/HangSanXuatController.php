<?php

namespace App\Http\Controllers\admin;

use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class HangSanXuatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hangsanxuat = HangSanXuat::all();
        return view('admin.hangsanxuat.index', compact('hangsanxuat'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hangsanxuat.them');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Kiểm tra dữ liệu
        $request->validate([
            'tenhang' => ['required', 'string', 'max:191', 'unique:hangsanxuat'],
            'hinhanh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            // image : bắt buộc phải là file hình
            // mimes : nhận đuôi hình hợp lệ
            // max : giới hạn dung lượng tối đa 2MB
        ]);

        // 2. Gắn dữ liệu chữ
        $hangsanxuat = new HangSanXuat();
        $hangsanxuat->tenhang = $request->tenhang;
        $hangsanxuat->tenhang_slug = Str::slug($request->tenhang, '-'); 

        // 3. Xử lý hình ảnh (Nếu người dùng có chọn hình)
        if($request->hasFile('hinhanh')) {
            // lấy file hình ảnh
            $file = $request->file('hinhanh');
            
            // tạo tên file hình ảnh duy nhất
            $filename = time() . '_' . $hangsanxuat->tenhang_slug . '.' . $file->getClientOriginalExtension();
            
            // lưu file hình ảnh vào thư mục public/uploads/hangsanxuat (Tự động tạo thư mục nếu chưa có)
            $file->move(public_path('uploads/hangsanxuat'), $filename);
            
            // Chỉ cần lưu tên file vào Database thôi là đủ xài rồi
            $hangsanxuat->hinhanh = $filename;
        }

        // 4. Lưu vào Database
        $hangsanxuat->save();

        // 5. Trả về trang danh sách
        return redirect()->route('admin.hangsanxuat')->with('status', 'Thêm hãng sản xuất thành công!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(HangSanXuat $hangSanXuat)
    // {
   
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hangsanxuat = HangSanXuat::findOrFail($id);
        return view('admin.hangsanxuat.sua', compact('hangsanxuat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Kiểm tra dữ liệu (Lưu ý: unique phải loại trừ cái id hiện tại)
        $request->validate([
            'tenhang' => ['required', 'string', 'max:191', 'unique:hangsanxuat,tenhang,' . $id],
            'hinhanh' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ]);

        $hangsanxuat = HangSanXuat::findOrFail($id);
        $hangsanxuat->tenhang = $request->tenhang;
        $hangsanxuat->tenhang_slug = Str::slug($request->tenhang, '-');

        // 2. Xử lý hình ảnh nếu có up hình mới
        if($request->hasFile('hinhanh')){ 
            
            // BƯỚC QUAN TRỌNG: Xóa hình cũ trước khi up hình mới
            if($hangsanxuat->hinhanh && file_exists(public_path('uploads/hangsanxuat/' . $hangsanxuat->hinhanh))) {
                unlink(public_path('uploads/hangsanxuat/' . $hangsanxuat->hinhanh));
            }

            // Up hình mới
            $file = $request->file('hinhanh');
            $filename = time() . '_' . $hangsanxuat->tenhang_slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/hangsanxuat'), $filename);
            
            // Cập nhật tên file mới vào DB
            $hangsanxuat->hinhanh = $filename; 
        }

        $hangsanxuat->save();
        return redirect()->route('admin.hangsanxuat')->with('status', 'Cập nhật hãng sản xuất thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hangsanxuat = HangSanXuat::findOrFail($id);

        // BƯỚC QUAN TRỌNG: Tìm và xóa tấm hình trong thư mục public
        if($hangsanxuat->hinhanh && file_exists(public_path('uploads/hangsanxuat/' . $hangsanxuat->hinhanh))) {
            unlink(public_path('uploads/hangsanxuat/' . $hangsanxuat->hinhanh));
        }

        // Xóa data trong Database
        $hangsanxuat->delete();

        return redirect()->route('admin.hangsanxuat')->with('status', 'Xóa hãng sản xuất thành công!');
    }
}
