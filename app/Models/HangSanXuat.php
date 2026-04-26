<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class HangSanXuat extends Model
{
    protected $table = 'hangsanxuat';

    public function SanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'hangsanxuat_id', 'id');
        // haasMany là một quan hệ giữa hai bảng, trong đó một bản ghi của bảng cha có thể liên kết với nhiều bản ghi của bảng con. Trong trường hợp này, một nhà sản xuất (HangSanXuat) có thể sản xuất nhiều sản phẩm (SanPham).
    }
}
