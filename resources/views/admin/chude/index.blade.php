@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý chủ đề bài viết</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách các chủ đề</h5>
            <a href="{{ route('admin.chude.them') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0 w-100">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Tên chủ đề</th>
                        <th>Tên chủ đề (Slug)</th>
                        <th width="10%" class="text-center">Sửa</th>
                        <th width="10%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chude as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-primary-light text-primary">{{ $value->tenchude }}</span></td>
                        <td class="text-muted">{{ $value->tenchude_slug }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.chude.sua', ['id' => $value->id]) }}">
                                <i class="align-middle text-warning" data-feather="edit-2"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.chude.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có muốn xóa chủ đề {{ $value->tenchude }} không?')">
                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger py-4">Chưa có chủ đề nào được tạo!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
