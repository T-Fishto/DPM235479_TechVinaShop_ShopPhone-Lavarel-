@extends('layouts.app')

@section('content')
<div class="container login-container">
    <div class="login-card">
        
        <div class="text-center">
            <h1>Đăng Nhập</h1>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label">Tên đăng nhập (Email)</label>
                <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nhập email của bạn">
                @error('email')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Mật khẩu</label>
                <input id="password" type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-white-50" for="remember" style="font-size: 0.9rem;">
                        Ghi nhớ tài khoản
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>

            {{-- Hai nút Đăng nhập và Đăng ký xếp chồng lên nhau --}}
            <div class="d-grid gap-3 mt-4">
                <button type="submit" class="btn btn-login">
                    Đăng Nhập Ngay
                </button>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-register">
                        Tạo tài khoản mới
                    </a>
                @endif

                <div class="text-center my-2 text-white-50">Hoặc</div>

                <a href="{{ route('login.google') }}" class="btn-google">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                    Đăng nhập bằng Google
                </a>
            </div>
        </form>
        
    </div>
</div>
@endsection