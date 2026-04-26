<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DanhGia extends Model
{
    protected $table = 'danhgia';
    protected $fillable = [
        'sanpham_id',
        'user_id',
        'diem',
        'noidung',
        'kichhoat',
    ];

    public function SanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Tims(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DanhGiaTim::class, 'danhgia_id', 'id');
    }
}
