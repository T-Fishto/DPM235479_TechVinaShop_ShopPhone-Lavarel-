@extends('layouts.admin')

@section('title', 'Thêm loại sản phẩm')

@section('content')
<div class="container-fluid p-0">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Thêm loại sản phẩm mới</h5>
    </div>
    <div class="card-body">

            {{-- Hiển thị lỗi validation NỔI Ở TRÊN CÙNG --}}
        @if ($errors->any())
            <div class="alert bg-danger text-white alert-dismissible fade show shadow-lg" 
                style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px;" 
                role="alert">
                
                <strong><i class="align-middle me-1" data-feather="alert-triangle"></i> Có lỗi xảy ra!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="top: 5px; right: 5px;"></button>
            </div>
        @endif

        <form action="{{ route('admin.loaisanpham.them') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên loại sản phẩm <span class="text-danger">*</span></label>
                <input type="text" 
                       name="tenloai" 
                       class="form-control @error('tenloai') is-invalid @enderror"
                       value="{{ old('tenloai') }}"
                       placeholder="Ví dụ: Điện thoại, Laptop...">
                @error('tenloai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="mota" class="form-control" rows="3">{{ old('mota') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Lưu vào CSDL
            </button>
            <a href="{{ route('admin.loaisanpham') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
</div>
@endsection