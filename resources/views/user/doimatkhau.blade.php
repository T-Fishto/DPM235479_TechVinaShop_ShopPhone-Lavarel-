@extends('layouts.frontend')
@section('title', 'Đổi mật khẩu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark border-secondary border-opacity-25 rounded-0 animate__animated animate__fadeInUp">
                <div class="card-header border-bottom border-secondary border-opacity-25 bg-transparent p-4">
                    <h4 class="text-gold playfair mb-0 text-center text-uppercase tracking-widest">Đổi Mật Khẩu</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('user.doimatkhau') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Mật khẩu cũ</label>
                            <div class="input-group">
                                <input type="password" id="old_password" class="form-control bg-transparent text-white border-secondary border-end-0 @error('old_password') is-invalid @enderror" name="old_password" autocomplete="off" required>
                                <button class="btn btn-outline-secondary border-secondary border-start-0 bg-transparent btn-toggle-pw" type="button" data-target="#old_password">
                                    <i class="fa-solid fa-eye text-gold"></i>
                                </button>
                                @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control bg-transparent text-white border-secondary border-end-0 @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>
                                <button class="btn btn-outline-secondary border-secondary border-start-0 bg-transparent btn-toggle-pw" type="button" data-target="#password">
                                    <i class="fa-solid fa-eye text-gold"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Xác nhận mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" class="form-control bg-transparent text-white border-secondary border-end-0" name="password_confirmation" autocomplete="new-password" required>
                                <button class="btn btn-outline-secondary border-secondary border-start-0 bg-transparent btn-toggle-pw" type="button" data-target="#password_confirmation">
                                    <i class="fa-solid fa-eye text-gold"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lux py-3">Cập Nhật Mật Khẩu</button>
                            <a href="{{ route('user.home') }}" class="btn btn-outline-secondary py-2 mt-2">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-toggle-pw').forEach(button => {
        button.addEventListener('click', function() {
            const targetSelector = this.getAttribute('data-target');
            const passwordInput = document.querySelector(targetSelector);
            const eyeIcon = this.querySelector('i');
            
            // Chuyển đổi kiểu input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Chuyển đổi icon
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    });
</script>
@endpush
