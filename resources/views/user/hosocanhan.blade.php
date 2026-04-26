@extends('layouts.frontend')
@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark border-secondary border-opacity-25 rounded-0 animate__animated animate__fadeInUp">
                <div class="card-header border-bottom border-secondary border-opacity-25 bg-transparent p-4">
                    <h4 class="text-gold playfair mb-0 text-center text-uppercase tracking-widest">Hồ Sơ Cá Nhân</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('user.hosocanhan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if($nguoidung->hinhanh)
                                    <img src="{{ asset('uploads/profile/' . $nguoidung->hinhanh) }}" alt="Avatar" class="rounded-circle object-fit-cover border border-gold" width="120" height="120">
                                @else
                                    <div class="rounded-circle bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center border border-gold mx-auto" style="width: 120px; height: 120px;">
                                        <i class="fa-solid fa-user text-secondary fs-1"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-3">
                                <label for="hinhanh" class="form-label text-gold small">Đổi ảnh đại diện</label>
                                <input class="form-control bg-dark text-white border-secondary @error('hinhanh') is-invalid @enderror" type="file" id="hinhanh" name="hinhanh" accept="image/*">
                                @error('hinhanh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Họ và tên</label>
                            <input type="text" class="form-control bg-transparent text-white border-secondary @error('name') is-invalid @enderror" name="name" value="{{ old('name', $nguoidung->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Tên đăng nhập</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary border-opacity-50" value="{{ $nguoidung->username }}" readonly disabled style="opacity: 1;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Email</label>
                            <input type="email" class="form-control bg-transparent text-white border-secondary @error('email') is-invalid @enderror" name="email" value="{{ old('email', $nguoidung->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Điện thoại</label>
                            <input type="text" class="form-control bg-transparent text-white border-secondary @error('dienthoai') is-invalid @enderror" name="dienthoai" value="{{ old('dienthoai', $nguoidung->dienthoai) }}">
                            @error('dienthoai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Địa chỉ</label>
                            <textarea class="form-control bg-transparent text-white border-secondary @error('diachi') is-invalid @enderror" name="diachi" rows="3">{{ old('diachi', $nguoidung->diachi) }}</textarea>
                            @error('diachi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lux py-3">Lưu Thay Đổi</button>
                            <a href="{{ route('user.home') }}" class="btn btn-outline-secondary py-2 mt-2">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
