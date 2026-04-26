@extends('layouts.admin')
@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý sản phẩm</h1>

    {{-- HIỂN THỊ THÔNG BÁO THÀNH CÔNG --}}
   @if (session('status') || session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="alert-message">
                <i class="align-middle me-1" data-feather="check-circle"></i>
                <strong>Thành công!</strong> {{ session('status') }}
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
        <div>
            <a href="{{ route('admin.sanpham.them') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Thêm sản phẩm
            </a>
            {{-- Nút Xuất Excel --}}
            <a href="{{ route('admin.sanpham.xuat') }}" class="btn btn-info">
                <i class="align-middle" data-feather="download"></i> Xuất ra Excel
            </a>
            {{-- Nút Nhập Excel (Mở Modal) --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="align-middle" data-feather="upload"></i> Nhập từ Excel
            </button>
        </div>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0 align-middle">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại / Hãng</th>
                        <th class="text-end">Số lượng</th>
                        <th class="text-end">Đơn giá</th>
                        <th width="5%" class="text-center">Sửa</th>
                        <th width="5%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sanpham as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($value->hinhanh)
                                <img src="{{ asset('uploads/sanpham/' . $value->hinhanh) }}" width="60" class="img-thumbnail">
                            @else
                                <span class="badge bg-secondary">No image</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $value->tensanpham }}</strong>
                            <br><small class="text-muted">{{ $value->tensanpham_slug }}</small>
                        </td>
                        <td>
                            {{-- Chỗ này gọi qua relationship, không dùng biến lẻ $loaisanpham --}}
                            <span class="badge bg-info text-white">{{ $value->LoaiSanPham->tenloai }}</span>
                            <br>
                            <span class="badge bg-dark text-white">{{ $value->HangSanXuat->tenhang }}</span>
                        </td>
                        <td class="text-end">{{ number_format($value->soluong) }}</td>
                        <td class="text-end text-primary fw-bold">{{ number_format($value->dongia, 0, ',', '.') }}đ</td>
                        <td class="text-center">
                            <a href="{{ route('admin.sanpham.sua', ['id' => $value->id]) }}">
                                <i class="align-middle text-warning" data-feather="edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.sanpham.xoa', ['id' => $value->id]) }}" 
                               onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham }} không?')">
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
{{-- 2. ĐẶT MODAL Ở ĐÂY (NGOÀI CARD VÀ NGOÀI VÒNG LẶP) --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.sanpham.nhap') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập sản phẩm từ file Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-danger fw-bold">Lưu ý: Tiêu đề cột trong file Excel phải khớp với hệ thống.</label>
                        <input type="file" name="file_excel" class="form-control" required accept=".xlsx, .xls">
                    </div>
                    <div class="alert alert-info py-2 mb-0">
                        <small><i class="align-middle me-1" data-feather="help-circle"></i> Mẹo: Hãy <strong>Xuất ra Excel</strong> trước để lấy file mẫu chuẩn nhất!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-success">Bắt đầu nhập</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection