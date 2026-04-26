<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaiViet extends Model
{
    protected $table = 'baiviet';
    protected $fillable = [
        'chude_id',
        'user_id',
        'tieude',
        'tieude_slug',
        'tomtat',
        'noidung',
        'hinhanh',
        'luotxem',
        'kichhoat',
    ];

    public function ChuDe(): BelongsTo
    {
        return $this->belongsTo(ChuDe::class, 'chude_id', 'id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
