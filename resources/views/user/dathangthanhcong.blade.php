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
        // Chỉ xóa các sản phẩm đã mua (selected = true)
        // Giữ lại các sản phẩm chưa được chọn (selected = false)
        let remainingCart = [];
        try {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            remainingCart = cart.filter(item => item.selected === false);

            if (remainingCart.length > 0) {
                localStorage.setItem('cart', JSON.stringify(remainingCart));
            } else {
                localStorage.removeItem('cart');
            }
        } catch(e) {
            localStorage.removeItem('cart');
        }

        // Cập nhật số lượng trên badge giỏ hàng
        // KHÔNG gọi clearCart() vì nó sẽ ghi đè localStorage về rỗng!
        const totalRemaining = remainingCart.reduce((sum, item) => sum + item.quantity, 0);
        const badge = document.getElementById('cartCountBadge');
        if (badge) badge.textContent = totalRemaining;
    });
</script>
@endpush

