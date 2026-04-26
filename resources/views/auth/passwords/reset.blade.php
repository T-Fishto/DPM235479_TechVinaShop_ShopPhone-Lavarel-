@extends('layouts.app')

@section('content')
<link href="{{ asset('css/auth-style.css') }}" rel="stylesheet">

<div class="container auth-container">
    <div class="auth-card">
        <div class="text-center">
            <h1>Đặt Lại Mật Khẩu</h1>
            <p class="text-white-50 small">Vui lòng nhập mật khẩu mới cho tài khoản của bạn.</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">Địa chỉ Email</label>
                <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                @error('email')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu mới</label>
                <input id="password" type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu mới">
                @error('password')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="form-label">Xác nhận mật khẩu mới</label>
                <input id="password-confirm" type="password" class="form-control form-control-custom" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu mới">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-submit">
                    Cập Nhật Mật Khẩu Ngay
                </button>
            </div>
        </form>
    </div>
</div>
@endsection