@extends('layouts.frontend')
@section('title', 'Đặt Hàng Thành Công')

@section('content')
<div class="container py-5 text-center animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="bg-dark p-5 border border-secondary border-opacity-25 rounded-0">
                <i class="fa-solid fa-circle-check text-gold mb-4" style="font-size: 5rem;"></i>
                <h2 class="display-6 playfair text-gold mb-3">Đặt Hàng Thành Công!</h2>
                <div class="bg-gold mx-auto mb-4" style="width: 60px; height: 2px;"></div>
                
                <p class="text-white lead mb-4">Cảm ơn bạn đã tin tưởng và mua sắm tại Tech VinaShop.</p>
                <p class="text-muted small mb-5">Đơn hàng của bạn đang được xử lý. Chúng tôi sẽ liên hệ với bạn qua số điện thoại đã cung cấp để xác nhận trong thời gian sớm nhất.</p>
                
                <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                    <a href="{{ route('user.donhang') }}" class="btn btn-outline-light px-4 py-2 text-uppercase tracking-widest small">Lịch sử đơn hàng</a>
                    <a href="{{ route('frontend.sanpham') }}" class="btn btn-lux px-4 py-2 text-uppercase tracking-widest small">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xóa giỏ hàng trong localStorage sau khi đặt hàng thành công
        localStorage.removeItem('cart');
        
        // Gọi hàm clearCart() từ cart.js (nếu có) để cập nhật giao diện
        if(typeof window.clearCart === 'function') {
            window.clearCart();
        } else {
            // Thủ công reset số trên icon nếu không dùng cart.js chung
            let badge = document.querySelector('.badge.bg-gold');
            if(badge) badge.textContent = '0';
        }
    });
</script>
@endpush
