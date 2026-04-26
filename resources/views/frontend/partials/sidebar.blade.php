<!-- Offcanvas Cart (Dạng Sidebar trượt) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title playfair text-gold">Túi hàng của bạn</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div id="cartItemsList" class="flex-grow-1 overflow-auto">
            <div class="text-center mt-5">
                <i class="fa-solid fa-hourglass-start text-muted mb-3" style="font-size: 3rem;"></i>
                <p class="text-muted">Giỏ hàng của bạn đang trống</p>
            </div>
        </div>
        
        <div class="cart-footer p-3 border-top border-secondary bg-dark">
            <div class="form-check mb-3">
                <input class="form-check-input custom-checkbox" type="checkbox" id="agreeTerms">
                <label class="form-check-label small text-white opacity-75" for="agreeTerms" style="font-size: 0.75rem;">
                    Tôi đồng ý với điều khoản mua hàng
                </label>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-uppercase small tracking-widest text-white">Tổng cộng:</span>
                <span class="text-gold fw-bold" id="cartTotalPrice">0đ</span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-light w-50 py-2 small text-uppercase tracking-widest" data-bs-dismiss="offcanvas" style="font-size: 0.7rem;">Tiếp tục mua</button>
                <a href="{{ route('user.dathang') }}" class="btn btn-lux w-50 py-2 small text-uppercase tracking-widest disabled" id="checkoutBtn" style="font-size: 0.7rem;">Thanh toán</a>
            </div>
        </div>
    </div>
</div>
