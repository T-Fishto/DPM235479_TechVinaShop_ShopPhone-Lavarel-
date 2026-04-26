@extends('layouts.admin')

@section('title', 'Sửa loại sản phẩm')

@section('content')
<div class="container-fluid p-0">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Chỉnh sửa loại sản phẩm</h5>
    </div>
    <div class="card-body">

        {{-- Hiển thị lỗi validation --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Có lỗi xảy ra!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.loaisanpham.sua', $loaisanpham->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên loại sản phẩm <span class="text-danger">*</span></label>
                <input type="text" 
                       name="tenloai" 
                       class="form-control @error('tenloai') is-invalid @enderror"
                       value="{{ old('tenloai', $loaisanpham->tenloai) }}">
                @error('tenloai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="mota" class="form-control" rows="3">{{ old('mota', $loaisanpham->mota) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.loaisanpham') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
</div>
@endsection