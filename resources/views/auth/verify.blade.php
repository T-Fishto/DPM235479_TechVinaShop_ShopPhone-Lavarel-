@extends('layouts.app')

@section('content')
   
<div class="container auth-container">
    <div class="auth-card text-center">
        
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#6a8caf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
        </div>

        <h3>Xác Thực Email Của Bạn</h3>

        <div class="text-white-50 mb-4" style="line-height: 1.6; font-size: 0.95rem;">
            @if (session('resent'))
                <div class="alert alert-custom text-start p-3 mb-4" role="alert">
                    <i class="align-middle me-2" data-feather="check-circle"></i>
                    Một đường dẫn xác thực mới vừa được gửi đến địa chỉ email của bạn.
                </div>
            @endif

            <p>Trước khi tiếp tục, vui lòng kiểm tra hộp thư email của bạn để lấy đường dẫn xác thực.</p>
            <p class="mb-0">Nếu bạn không nhận được email,</p>
            
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline btn-link-custom">bấm vào đây để yêu cầu gửi lại</button>.
            </form>
        </div>

    </div>
</div>
@endsection