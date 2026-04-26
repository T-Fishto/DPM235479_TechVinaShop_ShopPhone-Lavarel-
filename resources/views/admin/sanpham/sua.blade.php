@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Chỉnh sửa sản phẩm: {{ $sanpham->tensanpham }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sanpham.sua', ['id' => $sanpham->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- 1. Chọn Loại Sản Phẩm (ComboBox) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Loại sản phẩm <span class="text-danger">*</span></label>
                        <select class="form-select @error('loaisanpham_id') is-invalid @enderror" name="loaisanpham_id" required>
                            @foreach($loaisanpham as $value)
                                <option value="{{ $value->id }}" {{ ($sanpham->loaisanpham_id == $value->id) ? 'selected' : '' }}>
                                    {{ $value->tenloai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 2. Chọn Hãng Sản Xuất (ComboBox) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hãng sản xuất <span class="text-danger">*</span></label>
                        <select class="form-select @error('hangsanxuat_id') is-invalid @enderror" name="hangsanxuat_id" required>
                            @foreach($hangsanxuat as $value)
                                <option value="{{ $value->id }}" {{ ($sanpham->hangsanxuat_id == $value->id) ? 'selected' : '' }}>
                                    {{ $value->tenhang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="tensanpham" class="form-control @error('tensanpham') is-invalid @enderror" value="{{ old('tensanpham', $sanpham->tensanpham) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="soluong" class="form-control" value="{{ old('soluong', $sanpham->soluong) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Đơn giá <span class="text-danger">*</span></label>
                        <input type="number" name="dongia" class="form-control" value="{{ old('dongia', $sanpham->dongia) }}" required>
                    </div>
                </div>

                {{-- PHẦN HÌNH ẢNH --}}
                <div class="mb-3">
                    <label class="form-label">Hình ảnh hiện tại</label>
                    <div class="mb-2">
                        @if($sanpham->hinhanh)
                            <img src="{{ asset('uploads/sanpham/' . $sanpham->hinhanh) }}" width="150" class="img-thumbnail d-block">
                        @else
                            <span class="badge bg-secondary">Chưa có hình</span>
                        @endif
                    </div>
                    <label class="form-label">Chọn ảnh mới (nếu muốn đổi)</label>
                    <input type="file" name="hinhanh" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="motasanpham" class="form-control" rows="4">{{ old('motasanpham', $sanpham->motasanpham) }}</textarea>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                <a href="{{ route('admin.sanpham') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection