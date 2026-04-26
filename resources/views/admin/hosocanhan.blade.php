@extends('layouts.admin')

@section('title', 'Hồ sơ cá nhân Admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Hồ sơ cá nhân</h1>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Cập nhật thông tin</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hosocanhan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-4">
                            @if($nguoidung->hinhanh)
                                <img src="{{ asset('uploads/profile/' . $nguoidung->hinhanh) }}" alt="Avatar" class="img-fluid rounded-circle mb-2" width="128" height="128">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto mb-2 text-white" style="width: 128px; height: 128px; font-size: 3rem;">
                                    <i class="align-middle" data-feather="user"></i>
                                </div>
                            @endif
                            <div>
                                <label for="hinhanh" class="form-label btn btn-sm btn-primary">Đổi ảnh đại diện</label>
                                <input class="form-control d-none @error('hinhanh') is-invalid @enderror" type="file" id="hinhanh" name="hinhanh" accept="image/*" onchange="document.getElementById('filename-display').innerText = this.files[0].name;">
                                <div id="filename-display" class="small text-muted mt-1"></div>
                                @error('hinhanh')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $nguoidung->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control bg-light" value="{{ $nguoidung->username }}" readonly disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $nguoidung->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Điện thoại</label>
                            <input type="text" class="form-control @error('dienthoai') is-invalid @enderror" name="dienthoai" value="{{ old('dienthoai', $nguoidung->dienthoai) }}">
                            @error('dienthoai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control @error('diachi') is-invalid @enderror" name="diachi" rows="3">{{ old('diachi', $nguoidung->diachi) }}</textarea>
                            @error('diachi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
