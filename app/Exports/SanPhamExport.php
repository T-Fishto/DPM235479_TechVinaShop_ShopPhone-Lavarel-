<?php

namespace App\Exports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SanPhamExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return SanPham::all();
    }

    // Đặt tên tiêu đề cho cột Excel (Khớp với file Import Cách 2)
    public function headings(): array
    {
        return [
            'loaisanpham_id',
            'hangsanxuat_id',
            'tensanpham',
            'tensanpham_slug',
            'soluong',
            'dongia',
            'hinhanh',
            'motasanpham'
        ];
    }

    // Ánh xạ dữ liệu tương ứng với tiêu đề
    public function map($row): array
    {
        return [
            $row->loaisanpham_id,
            $row->hangsanxuat_id,
            $row->tensanpham,
            $row->tensanpham_slug,
            $row->soluong,
            $row->dongia,
            $row->hinhanh,
            $row->motasanpham,
        ];
    }
}