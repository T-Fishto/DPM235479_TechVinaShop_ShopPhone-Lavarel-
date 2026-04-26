@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý hãng sản xuất</h1>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách các hãng sản xuất</h5>
            <div>
                {{-- Nút Nhập/Xuất Excel cho Phần 6 --}}
                <a href="#" class="btn btn-success me-1">
                    <i class="align-middle" data-feather="download"></i> Xuất Excel
                </a>
                <a href="{{ route('admin.hangsanxuat.them') }}" class="btn btn-primary">
                    <i class="align-middle" data-feather="plus"></i> Thêm mới
                </a>
            </div>
        </div>
        <div class="card-body">
            
            {{-- Hiện thông báo thành công nếu có --}}
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thành công!</strong> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-hover my-0 w-100 align-middle">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Tên hãng</th>
                        <th>Tên hãng (Slug)</th>
                        <th width="15%">Hình ảnh Logo</th>   
                        <th width="10%" class="text-center">Sửa</th>
                        <th width="10%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hangsanxuat as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-info-light text-info fs-6">{{ $value->tenhang }}</span></td>
                        <td class="text-muted">{{ $value->tenhang_slug }}</td>
                        
                        {{-- XỬ LÝ HIỂN THỊ HÌNH ẢNH Ở ĐÂY --}}
                        <td>
                            @if($value->hinhanh)
                                <img src="{{ asset('uploads/hangsanxuat/' . $value->hinhanh) }}" 
                                     alt="Logo {{ $value->tenhang }}" 
                                     style="width: 120px; height: 60px; object-fit: contain; background: #fff; padding: 5px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                            @else
                                <span class="badge bg-secondary">Không có hình</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.hangsanxuat.sua', ['id' => $value->id]) }}">  
                                <i class="align-middle text-warning" data-feather="edit-2"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.hangsanxuat.xoa', ['id' => $value->id]) }}" 
                            onclick="return confirm('Bạn có chắc chắn muốn xóa tình trạng: {{ $value->tinhtrang }}?')">   
                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Sửa colspan thành 6 vì bảng có 6 cột --}}
                        <td colspan="6" class="text-center text-danger py-4">
                            <i class="align-middle mb-2 text-muted" data-feather="box" style="width: 40px; height: 40px;"></i>
                            <br>
                            Chưa có dữ liệu hãng sản xuất nào!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection