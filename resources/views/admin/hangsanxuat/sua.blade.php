@extends('layouts.admin')

@section('title', 'Sửa hãng sản xuất')

@section('content')
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Chỉnh sửa hãng sản xuất</h5>
        </div>
        <div class="card-body">

            {{-- Hiển thị lỗi validation --}}
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

            {{-- SỬA ROUTE, ĐỔI BIẾN VÀ THÊM ENCTYPE --}}
            <form action="{{ route('admin.hangsanxuat.sua', ['id' => $hangsanxuat->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Tên hãng sản xuất <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="tenhang" 
                           class="form-control @error('tenhang') is-invalid @enderror"
                           value="{{ old('tenhang', $hangsanxuat->tenhang) }}">
                    @error('tenhang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- THAY MÔ TẢ BẰNG PHẦN CẬP NHẬT HÌNH ẢNH --}}
                <div class="mb-3">
                    <label class="form-label">Hình ảnh Logo hiện tại</label>
                    <div class="mb-2">
                        @if($hangsanxuat->hinhanh)
                            {{-- Nếu có hình thì in ra --}}
                            <img src="{{ asset('uploads/hangsanxuat/' . $hangsanxuat->hinhanh) }}" alt="Logo" 
                                 style="width: 120px; height: 60px; object-fit: contain; background: #fff; padding: 5px; border-radius: 8px; border: 1px solid #dee2e6; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        @else
                            {{-- Nếu trước đó chưa up hình thì báo chữ --}}
                            <span class="badge bg-secondary">Chưa có hình ảnh</span>
                        @endif
                    </div>
                    
                    <label class="form-label text-muted"><small>Chọn tệp mới nếu muốn thay đổi logo (Không bắt buộc)</small></label>
                    <input type="file" 
                           name="hinhanh" 
                           class="form-control @error('hinhanh') is-invalid @enderror"
                           accept="image/*">
                    @error('hinhanh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="align-middle" data-feather="check-circle"></i> Cập nhật
                </button>
                <a href="{{ route('admin.hangsanxuat') }}" class="btn btn-secondary">Quay lại</a>
            </form>
            
        </div>
    </div>
</div>
@endsection