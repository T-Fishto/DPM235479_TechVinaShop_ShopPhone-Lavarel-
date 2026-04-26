@extends('layouts.admin')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý tình trạng</h1>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách tình trạng đơn hàng</h5>
            <a href="{{ route('admin.tinhtrang.them') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Tên tình trạng</th>
                        <th width="10%" class="text-center">Sửa</th>
                        <th width="10%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tinhtrang as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        {{-- PHẦN THAY THẾ ĐỂ HIỂN THỊ MÀU --}}
                        <td>
                            @if($value->tinhtrang == 'Mới')
                                <span class="badge bg-info text-white">{{ $value->tinhtrang }}</span>
                            @elseif($value->tinhtrang == 'Đang xử lý')
                                <span class="badge bg-warning text-dark">{{ $value->tinhtrang }}</span>
                            @elseif($value->tinhtrang == 'Đã giao')
                                <span class="badge bg-success">{{ $value->tinhtrang }}</span>
                            @elseif($value->tinhtrang == 'Đã hủy')
                                <span class="badge bg-danger">{{ $value->tinhtrang }}</span>
                            
                            @else
                                <span class="badge bg-secondary">{{ $value->tinhtrang }}</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.tinhtrang.sua', ['id' => $value->id]) }}">
                                <i class="align-middle text-warning" data-feather="edit-2"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.tinhtrang.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa tình trạng: {{ $value->tinhtrang }}?')">
                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection