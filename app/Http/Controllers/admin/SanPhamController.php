<?php

namespace App\Http\Controllers\admin;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Imports\SanPhamImport;
use App\Exports\SanPhamExport;
use Maatwebsite\Excel\Facades\Excel;
use File;

class SanPhamController extends Controller
{
    /**
     * Danh sách sản phẩm
     */
    public function index()
    {
        // Nên dùng with() để nạp luôn thông tin Loại và Hãng, giúp tránh lỗi Undefined variable ở View
       // Nạp sẵn tên loại và tên hãng cùng với sản phẩm
        $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])->get();
        return view('admin.sanpham.index', compact('sanpham'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();
        return view('admin.sanpham.them', compact('loaisanpham', 'hangsanxuat'));
    }

    /**
     * Xử lý thêm mới
     */
    public function store(Request $request)
    {
        // 1. Kiểm tra dữ liệu
        $request->validate([
            'loaisanpham_id' => ['required'],
            'hangsanxuat_id' => ['required'],
            'tensanpham' => ['required', 'string', 'max:191', 'unique:sanpham'],
            'soluong' => ['required', 'numeric', 'min:0'],
            'dongia' => ['required', 'numeric', 'min:0'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);
        //lấy dữ liệu từ form điền vào CSDL
        $orm = new SanPham();
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->tensanpham = $request->tensanpham;
        $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
        $orm->soluong = $request->soluong;
        $orm->dongia = $request->dongia;
        $orm->motasanpham = $request->motasanpham;

        // 2. Xử lý lưu hình ảnh vào thư mục public/uploads/sanpham
        if($request->hasFile('hinhanh')) { // Kiểm tra nếu có file hình ảnh được tải lên
            $file = $request->file('hinhanh');
            $filename = time() . '_' . $orm->tensanpham_slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sanpham'), $filename);
            $orm->hinhanh = $filename; // Lưu tên file vào CSDL để sau này hiển thị hình ảnh
        }

        $orm->save();
        
        return redirect()->route('admin.sanpham')->with('status', 'Thêm sản phẩm thành công!');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $sanpham = SanPham::findOrFail($id); // Tìm sản phẩm theo ID, nếu không tìm thấy sẽ trả về lỗi 404
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();
        return view('admin.sanpham.sua', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
        //Đóng gói lại và khi bấm nút sửa sẽ có đầy đủ thông tin sản phẩm, loại sản phẩm và hãng sản xuất để hiển thị trong form chỉnh sửa
    }

    /**
     * Xử lý cập nhật (SỬA LỖI LOGIC Ở ĐÂY)
     */
    public function update(Request $request, $id)
    {
        // 1. Kiểm tra dữ liệu (Lưu ý: unique tensanpham phải trừ ID hiện tại)
        $request->validate([
            'loaisanpham_id' => ['required'],
            'hangsanxuat_id' => ['required'],
            'tensanpham' => ['required', 'string', 'max:191', 'unique:sanpham,tensanpham,' . $id],
            'soluong' => ['required', 'numeric', 'min:0'],
            'dongia' => ['required', 'numeric', 'min:0'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);
        
        // PHẢI DÙNG findOrFail($id) thay vì new SanPham() để cập nhật bản ghi cũ
        $orm = SanPham::findOrFail($id); 
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->tensanpham = $request->tensanpham;
        $orm->tensanpham_slug = Str::slug($request->tensanpham, '-');
        $orm->soluong = $request->soluong;
        $orm->dongia = $request->dongia;
        $orm->motasanpham = $request->motasanpham;

        // 2. Xử lý lưu hình ảnh mới và xóa ảnh cũ
        if($request->hasFile('hinhanh')) {
            // Xóa ảnh cũ nếu có trong thư mục
            if($orm->hinhanh && file_exists(public_path('uploads/sanpham/' . $orm->hinhanh))) {
                unlink(public_path('uploads/sanpham/' . $orm->hinhanh));
            }

            // Lưu ảnh mới
            $file = $request->file('hinhanh');
            $filename = time() . '_' . $orm->tensanpham_slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sanpham'), $filename);
            $orm->hinhanh = $filename;
        }

        $orm->save();
        
        return redirect()->route('admin.sanpham')->with('status', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        $orm = SanPham::findOrFail($id);

        // 1. Xử lý xóa file hình ảnh vật lý nếu có
        if($orm->hinhanh && file_exists(public_path('uploads/sanpham/' . $orm->hinhanh))) {
            unlink(public_path('uploads/sanpham/' . $orm->hinhanh));
        }

        // 2. Xóa dữ liệu trong CSDL
        $orm->delete();

        return redirect()->route('admin.sanpham')->with('status', 'Đã xóa sản phẩm thành công!');
    }
    // Hàm Xuất Excel
    public function getXuat()
    {
        return Excel::download(new SanPhamExport, 'danh-sach-san-pham.xlsx');
    }

    // Hàm Nhập Excel
    public function postNhap(Request $request)
    {
        if($request->hasFile('file_excel')){
            try {
                Excel::import(new SanPhamImport, $request->file('file_excel'));
                return redirect()->route('admin.sanpham')->with('success', 'Nhập dữ liệu thành công!');
            } catch (\Exception $e) {
                return back()->with('error', 'Lỗi dữ liệu: ' . $e->getMessage());
            }
        }
        return back()->with('error', 'Vui lòng chọn file Excel!');
    }
}