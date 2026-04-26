@extends('layouts.app')

@section('content')
<div class="container auth-container">
    <div class="auth-card">
        <div class="text-center">
            <h1>Đăng Ký</h1>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Họ và tên</label>
                <input id="name" type="text" class="form-control form-control-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="VD: Nguyễn Văn Thắng">
                @error('name')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Địa chỉ Email</label>
                <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="VD: thang@gmail.com">
                @error('email')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Tối thiểu 8 ký tự">
                @error('password')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
                <input id="password-confirm" type="password" class="form-control form-control-custom" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu ở trên">
            </div>

            <div class="d-grid gap-3 mt-2">
                <button type="submit" class="btn btn-submit">
                    Đăng Ký Tài Khoản
                </button>
                
                <div class="text-center mt-2">
                    <span class="text-white-50 small">Đã có tài khoản?</span>
                    <a href="{{ route('login') }}" class="text-white text-decoration-none fw-bold small ms-1">Đăng nhập ngay</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection