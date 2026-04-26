@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Thêm sản phẩm mới</h5>
        </div>
        <div class="card-body">
            
            {{-- Hiển thị lỗi validation --}}
            @if ($errors->any())
                <div class="alert bg-danger text-white alert-dismissible fade show shadow-sm" role="alert">
                    <strong><i class="align-middle me-1" data-feather="alert-triangle"></i> Có lỗi xảy ra!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.sanpham.them') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- 1. Chọn Loại Sản Phẩm (ComboBox) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Loại sản phẩm <span class="text-danger">*</span></label>
                        <select class="form-select @error('loaisanpham_id') is-invalid @enderror" name="loaisanpham_id" required>
                            <option value="">-- Chọn loại --</option>
                            @foreach($loaisanpham as $value)
                                <option value="{{ $value->id }}" {{ old('loaisanpham_id') == $value->id ? 'selected' : '' }}>
                                    {{ $value->tenloai }}
                                </option>
                            @endforeach
                        </select>
                        @error('loaisanpham_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. Chọn Hãng Sản Xuất (ComboBox) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hãng sản xuất <span class="text-danger">*</span></label>
                        <select class="form-select @error('hangsanxuat_id') is-invalid @enderror" name="hangsanxuat_id" required>
                            <option value="">-- Chọn hãng --</option>
                            @foreach($hangsanxuat as $value)
                                <option value="{{ $value->id }}" {{ old('hangsanxuat_id') == $value->id ? 'selected' : '' }}>
                                    {{ $value->tenhang }}
                                </option>
                            @endforeach
                        </select>
                        @error('hangsanxuat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="tensanpham" class="form-control @error('tensanpham') is-invalid @enderror" 
                           value="{{ old('tensanpham') }}" placeholder="Nhập tên sản phẩm..." required>
                    @error('tensanpham')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="soluong" class="form-control @error('soluong') is-invalid @enderror" 
                               value="{{ old('soluong') }}" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Đơn giá <span class="text-danger">*</span></label>
                        <input type="number" name="dongia" class="form-control @error('dongia') is-invalid @enderror" 
                               value="{{ old('dongia') }}" min="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh sản phẩm</label>
                    <input type="file" name="hinhanh" class="form-control @error('hinhanh') is-invalid @enderror" accept="image/*">
                    @error('hinhanh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="motasanpham" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết...">{{ old('motasanpham') }}</textarea>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">
                    <i class="align-middle" data-feather="save"></i> Lưu vào CSDL
                </button>
                <a href="{{ route('admin.sanpham') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection