<?php

namespace App\Http\Controllers\admin;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TinhTrang;
use App\Models\DonHang_ChiTiet;

class DonHangController extends Controller
{
    public function index()
    {
        // Dùng with để lấy thông tin khách hàng và tình trạng cho nhanh
        $donhang = DonHang::with(['User', 'TinhTrang'])->orderBy('created_at', 'desc')->get();
        $tinhtrang = TinhTrang::all();
        return view('admin.donhang.index', compact('donhang', 'tinhtrang'));
    }

    public function edit($id)
    {
        $donhang = DonHang::findOrFail($id);
        $tinhtrang = TinhTrang::all();
        // Nhớ kiểm tra thư mục view của Thắng là admin.donhang hay donhang nhé
        return view('admin.donhang.sua', compact('donhang', 'tinhtrang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tinhtrang_id' => ['required'],
            'dienthoaigiaohang' => ['required', 'string', 'max:20'],
            'diachigiaohang' => ['required', 'string', 'max:191'],
        ]);
        
        $orm = DonHang::with('DonHang_ChiTiet.SanPham')->findOrFail($id);
        
        $old_status = $orm->tinhtrang_id;
        $new_status = $request->tinhtrang_id;

        \Illuminate\Support\Facades\DB::transaction(function () use ($orm, $request, $old_status, $new_status) {
            $orm->tinhtrang_id = $new_status;
            $orm->dienthoaigiaohang = $request->dienthoaigiaohang;
            $orm->diachigiaohang = $request->diachigiaohang;
            $orm->save();

            // Nếu đơn hàng chuyển sang trạng thái "Đã hủy" (ID: 4) từ trạng thái khác
            if ($new_status == 4 && $old_status != 4) {
                foreach ($orm->DonHang_ChiTiet as $chitiet) {
                    if ($chitiet->SanPham) {
                        $chitiet->SanPham->soluong += $chitiet->soluongban;
                        $chitiet->SanPham->save();
                    }
                }
            }
            // Nếu admin phục hồi đơn hàng từ trạng thái "Đã hủy" sang trạng thái khác
            elseif ($old_status == 4 && $new_status != 4) {
                foreach ($orm->DonHang_ChiTiet as $chitiet) {
                    if ($chitiet->SanPham) {
                        $chitiet->SanPham->soluong -= $chitiet->soluongban;
                        $chitiet->SanPham->save();
                    }
                }
            }
        });
        
        return redirect()->route('admin.donhang')->with('status', 'Cập nhật đơn hàng thành công!');
    }

    public function destroy($id)
    {
        $orm = DonHang::with('DonHang_ChiTiet.SanPham')->findOrFail($id);

        \Illuminate\Support\Facades\DB::transaction(function () use ($orm) {
            // Nếu đơn hàng chưa bị hủy (ID: 4) thì phải hoàn lại số lượng tồn kho trước khi xóa
            if ($orm->tinhtrang_id != 4) {
                foreach ($orm->DonHang_ChiTiet as $chitiet) {
                    if ($chitiet->SanPham) {
                        $chitiet->SanPham->soluong += $chitiet->soluongban;
                        $chitiet->SanPham->save();
                    }
                }
            }

            // Xóa chi tiết trước
            DonHang_ChiTiet::where('donhang_id', $orm->id)->delete();
            
            $orm->delete();
        });
        
        return redirect()->route('admin.donhang')->with('status', 'Xóa đơn hàng thành công!');
    }
}