<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SanPham extends Model
{
    protected $table = 'sanpham';
    
    protected $fillable = [
        'loaisanpham_id',
        'hangsanxuat_id',
        'tensanpham',
        'tensanpham_slug',
        'soluong',
        'dongia',
        'hinhanh',
        'motasanpham',
    ];

    public function HangSanXuat(): BelongsTo // mỗi sản phẩm thuộc về một nhà sản xuất
    {
        return $this->belongsTo(HangSanXuat::class, 'hangsanxuat_id', 'id');
    }
    // belongsTo là một quan hệ giữa hai bảng, trong đó một bản ghi của bảng con liên kết với một bản ghi của bảng cha. Trong trường hợp này, một sản phẩm (SanPham) thuộc về một nhà sản xuất (HangSanXuat).

    public function LoaiSanPham(): BelongsTo // mỗi sản phẩm thuộc về một loại sản phẩm
    {
        return $this->belongsTo(LoaiSanPham::class, 'loaisanpham_id', 'id');
    }
    public function DonHang_ChiTiet(): HasMany // mỗi sản phẩm có thể xuất hiện trong nhiều chi tiết đơn hàng
    {
        return $this->hasMany(DonHang_ChiTiet::class, 'sanpham_id', 'id');
    }
    public function DanhGia(): HasMany // mỗi sản phẩm có thể có nhiều đánh giá
    {
        return $this->hasMany(DanhGia::class, 'sanpham_id', 'id');
    }
}
