@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý loại sản phẩm</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách các loại hàng</h5>
            <div>
                {{-- Nút Nhập/Xuất Excel cho Phần 6 --}}
                <a href="#" class="btn btn-success me-1">
                    <i class="align-middle" data-feather="download"></i> Xuất Excel
                </a>
                <a href="{{ route('admin.loaisanpham.them') }}" class="btn btn-primary">
                    <i class="align-middle" data-feather="plus"></i> Thêm mới
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0 w-100">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Tên loại</th>
                        <th>Tên loại (Slug)</th>
                        <th>Mô tả</th>
                        <th width="10%" class="text-center">Sửa</th>
                        <th width="10%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loaisanpham as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-info-light text-info">{{ $value->tenloai }}</span></td>
                        <td class="text-muted">{{ $value->tenloai_slug }}</td>
                        <td>{{ $value->mota }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.loaisanpham.sua', ['id' => $value->id]) }}">
                                <i class="align-middle text-warning" data-feather="edit-2"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.loaisanpham.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có muốn xóa loại {{ $value->tenloai }} không?')">
                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">Danh sách trống!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection