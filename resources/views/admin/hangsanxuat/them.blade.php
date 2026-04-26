@extends('layouts.admin')

@section('title', 'Thêm hãng sản xuất')

@section('content')
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Thêm hãng sản xuất mới</h5>
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

            {{-- THÊM enctype="multipart/form-data" ĐỂ UPLOAD HÌNH --}}
            <form action="{{ route('admin.hangsanxuat.them') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Tên hãng sản xuất <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="tenhang" 
                           class="form-control @error('tenhang') is-invalid @enderror"
                           value="{{ old('tenhang') }}"
                           placeholder="Ví dụ: Apple, Samsung...">
                    @error('tenhang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ĐỔI KHUNG TEXTAREA THÀNH KHUNG CHỌN FILE HÌNH ẢNH --}}
                <div class="mb-3">
                    <label class="form-label">Hình ảnh Logo (Không bắt buộc)</label>
                    <input type="file" 
                           name="hinhanh" 
                           class="form-control @error('hinhanh') is-invalid @enderror"
                           accept="image/*"> {{-- accept="image/*" giúp hộp thoại chỉ hiện các file hình --}}
                    @error('hinhanh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Lưu vào CSDL
                </button>
                
                {{-- ĐỔI ROUTE QUAY LẠI --}}
                <a href="{{ route('admin.hangsanxuat') }}" class="btn btn-secondary">Quay lại</a>
            </form>
            
        </div>
    </div>
</div>
@endsection