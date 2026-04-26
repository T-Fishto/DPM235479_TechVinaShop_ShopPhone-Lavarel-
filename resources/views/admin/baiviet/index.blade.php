@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý bài viết</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách các bài viết</h5>
            <a href="{{ route('admin.baiviet.them') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0 w-100">
                <thead>
                    <tr>
                        <th width="2%">ID</th>
                        <th width="10%">Ảnh</th>
                        <th width="40%">Nội dung bài viết</th>
                        <th width="15%">Chủ đề</th>
                        <th width="10%">Tác giả</th>
                        <th width="8%" class="text-center">Lượt xem</th>
                        <th width="5%" class="text-center">Hiện</th>
                        <th width="5%" class="text-center">Sửa</th>
                        <th width="5%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($baiviet as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($value->hinhanh)
                                <img src="{{ asset('uploads/baiviet/' . $value->hinhanh) }}" width="60" class="rounded">
                            @else
                                <div class="bg-light text-center rounded p-2" style="width: 60px;">
                                    <i class="align-middle text-secondary" data-feather="image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $value->tieude }}</div>
                            <div class="text-muted small mb-1" style="font-size: 0.7rem;">{{ $value->tieude_slug }}</div>
                            <div class="text-secondary small" style="font-size: 0.7rem;"><i class="align-middle me-1" data-feather="calendar" style="width: 12px;"></i>{{ $value->created_at->format('d/m/Y') }}</div>
                        </td>
                        <td><span class="badge bg-secondary-light text-secondary border border-secondary border-opacity-25 px-2 py-1">{{ $value->ChuDe->tenchude }}</span></td>
                        <td><small class="text-muted">{{ $value->User->name }}</small></td>
                        <td class="text-center">
                            <span class="badge border text-dark fw-normal bg-light" style="min-width: 30px;">{{ $value->luotxem }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.baiviet.kichhoat', ['id' => $value->id]) }}">
                                @if($value->kichhoat == 1)
                                    <i class="align-middle text-success" data-feather="check-circle"></i>
                                @else
                                    <i class="align-middle text-danger" data-feather="slash"></i>
                                @endif
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.baiviet.sua', ['id' => $value->id]) }}">
                                <i class="align-middle text-warning" data-feather="edit-2"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.baiviet.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-danger py-4">Chưa có bài viết nào!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
