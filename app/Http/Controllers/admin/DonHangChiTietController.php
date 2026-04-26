<?php

namespace App\Http\Controllers\admin;

use App\Models\DonHang_ChiTiet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonHang;
class DonHangChiTietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 1. Tìm thông tin chung của Đơn hàng (Người mua, địa chỉ, tổng tiền...)
        $donhang = DonHang::find($id);

        // 2. Tìm tất cả các "Chi tiết" có chung mã donhang_id
        $chitiet = DonHang_ChiTiet::where('donhang_id', $id)->get();

        // 3. Đẩy dữ liệu ra view cho Admin xem
        return view('admin.donhang.chitiet', compact('donhang', 'chitiet'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonHang_ChiTiet $donHang_ChiTiet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonHang_ChiTiet $donHang_ChiTiet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang_ChiTiet $donHang_ChiTiet)
    {
        //
    }
}
