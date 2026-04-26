@extends('layouts.app')

@section('content')
<div class="container auth-container">
    <div class="auth-card">
        
        <div class="text-center mb-4">
            {{-- Icon ổ khóa --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#6a8caf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-3">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <h2>Khôi Phục Mật Khẩu</h2>
            <p class="text-white-50 small">Nhập email của bạn để nhận liên kết đặt lại mật khẩu.</p>
        </div>

        {{-- Thông báo khi gửi email thành công --}}
        @if (session('status'))
            <div class="alert alert-custom p-3 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Địa chỉ Email của bạn</label>
                <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="VD: thang@gmail.com">

                @error('email')
                    <span class="invalid-feedback fw-bold" style="color: #ff6b6b;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-submit">
                    Gửi Liên Kết Khôi Phục
                </button>
                
                <div class="text-center mt-2">
                    <a href="{{ route('login') }}" class="text-white-50 text-decoration-none small hover-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Quay lại đăng nhập
                    </a>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection