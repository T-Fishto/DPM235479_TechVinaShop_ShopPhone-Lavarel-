@extends('layouts.admin')
@section('title', 'Quản lý người dùng')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý người dùng</h1>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="align-middle me-1" data-feather="check-circle"></i>
            <strong>Thành công!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách tài khoản</h5>
            <a href="{{ route('admin.nguoidung.them') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="user-plus"></i> Thêm người dùng
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Họ và tên</th>
                        <th>Tên đăng nhập (Username)</th>
                        <th>Email</th>
                        <th width="10%" class="text-center">Quyền</th>
                        <th width="5%" class="text-center">Sửa</th>
                        <th width="5%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nguoidung as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $value->name }}</strong></td>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->email }}</td>
                        <td class="text-center">
                            @if($value->role == 'admin')
                                <span class="badge bg-danger">Quản trị viên</span>
                            @else
                                <span class="badge bg-secondary">Khách hàng</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.nguoidung.sua', ['id' => $value->id]) }}">
                                <i class="align-middle text-warning" data-feather="edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.nguoidung.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng {{ $value->name }}?')">
                                <i class="align-middle text-danger" data-feather="trash"></i>
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