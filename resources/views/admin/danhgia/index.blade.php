@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý đánh giá sản phẩm</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Danh sách các đánh giá từ khách hàng</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0 w-100">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="15%">Khách hàng</th>
                        <th width="15%">Sản phẩm</th>
                        <th width="10%" class="text-center">Số sao</th>
                        <th>Nội dung</th>
                        <th width="12%" class="text-center">Trạng thái</th>
                        <th width="8%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($danhgia as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold">{{ $value->User->name ?? 'Ẩn danh' }}</div>
                            <small class="text-muted">{{ $value->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        <td>
                            <small class="text-primary fw-bold">{{ $value->SanPham->tensanpham ?? 'Không xác định' }}</small>
                        </td>
                        <td class="text-center">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $value->diem ? 'text-warning' : 'text-secondary opacity-25' }}" style="font-size: 0.7rem;"></i>
                            @endfor
                        </td>
                        <td>
                            <div class="small text-dark" style="max-width: 300px;">{{ $value->noidung }}</div>
                        </td>
                        <td class="text-center">
                            @if($value->kichhoat == 0)
                                <a href="{{ route('admin.danhgia.duyet', ['id' => $value->id]) }}" class="btn btn-sm btn-info text-white py-0 px-2" style="font-size: 0.7rem;">Duyệt ngay</a>
                            @else
                                <a href="{{ route('admin.danhgia.kichhoat', ['id' => $value->id]) }}">
                                    <span class="badge bg-success">Đã duyệt</span>
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.danhgia.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger py-4">Chưa có đánh giá nào cần xử lý!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
