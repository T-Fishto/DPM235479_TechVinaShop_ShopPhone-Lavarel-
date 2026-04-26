<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DanhGiaTim extends Model
{
    protected $table = 'danhgia_tim';
    protected $fillable = [
        'danhgia_id',
        'user_id',
    ];

    public function DanhGia(): BelongsTo
    {
        return $this->belongsTo(DanhGia::class, 'danhgia_id', 'id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
