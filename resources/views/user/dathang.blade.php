@extends('layouts.frontend')
@section('title', 'Thanh Toán')

@section('content')
<div class="container py-5">
    <h2 class="display-5 playfair text-gold text-center mb-5">Thanh Toán</h2>



    <form action="{{ route('user.dathang') }}" method="POST">
        @csrf
        <div class="row g-5">
            <!-- Customer Info -->
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <div class="bg-dark p-4 border border-secondary border-opacity-25 rounded-0">
                    <h5 class="text-gold tracking-widest text-uppercase mb-4 small"><i class="fa-solid fa-address-card me-2"></i>Thông tin giao hàng</h5>
                    
                    <div class="mb-3">
                        <label class="form-label text-gold small text-uppercase tracking-widest">Họ và tên</label>
                        <input type="text" class="form-control bg-transparent text-white border-secondary" name="hovaten" value="{{ $nguoidung->name }}" readonly required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-gold small text-uppercase tracking-widest">Số điện thoại</label>
                        <input type="text" class="form-control bg-transparent text-white border-secondary" name="dienthoai" value="{{ $nguoidung->dienthoai }}" readonly required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-gold small text-uppercase tracking-widest">Email</label>
                        <input type="email" class="form-control bg-transparent text-white border-secondary" name="email" value="{{ $nguoidung->email }}" readonly required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-gold small text-uppercase tracking-widest">Địa chỉ nhận hàng</label>
                        <textarea class="form-control bg-transparent text-white border-secondary" name="diachi" rows="3" readonly required>{{ $nguoidung->diachi }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-gold small text-uppercase tracking-widest mb-3">Phương thức thanh toán</label>
                        <div class="d-grid gap-2">
                            <div class="payment-option">
                                <input type="radio" class="btn-check" name="phuongthuc" id="method_cod" value="COD" checked autocomplete="off">
                                <label class="btn btn-outline-secondary w-100 text-start p-3 border-secondary border-opacity-25 rounded-0 transition-all d-flex align-items-center" for="method_cod">
                                    <i class="fa-solid fa-truck-ramp-box text-gold me-3 fs-4"></i>
                                    <div>
                                        <div class="text-white small fw-bold">Thanh toán khi nhận hàng (COD)</div>
                                        <div class="text-secondary" style="font-size: 0.7rem;">Trả tiền mặt khi nhân viên giao hàng đến</div>
                                    </div>
                                    <i class="fa-solid fa-circle-check ms-auto check-icon text-gold"></i>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" class="btn-check" name="phuongthuc" id="method_bank" value="Bank" autocomplete="off">
                                <label class="btn btn-outline-secondary w-100 text-start p-3 border-secondary border-opacity-25 rounded-0 transition-all d-flex align-items-center" for="method_bank">
                                    <i class="fa-solid fa-building-columns text-gold me-3 fs-4"></i>
                                    <div>
                                        <div class="text-white small fw-bold">Chuyển khoản ngân hàng</div>
                                        <div class="text-secondary" style="font-size: 0.7rem;">Chuyển tiền trực tiếp vào tài khoản của shop</div>
                                    </div>
                                    <i class="fa-solid fa-circle-check ms-auto check-icon text-gold"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('user.hosocanhan') }}" class="text-gold text-decoration-none small text-uppercase tracking-widest transition-all"><i class="fa-solid fa-pen-to-square me-2"></i>Hồ sơ cá nhân</a>
                    </div>
                </div>
            </div>

            <!-- Order Details (Cart) -->
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="bg-dark p-4 border border-secondary border-opacity-25 rounded-0 h-100 d-flex flex-column">
                    <h5 class="text-gold tracking-widest text-uppercase mb-4 small"><i class="fa-solid fa-bag-shopping me-2"></i>Chi tiết đơn hàng</h5>
                    
                    <div id="checkoutCartItems" class="flex-grow-1 overflow-auto pe-2" style="max-height: 350px;">
                        <!-- JS will populate this -->
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-spinner fa-spin fs-1 mb-3"></i>
                            <p>Đang tải giỏ hàng...</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top border-secondary border-opacity-25">
                        {{-- Ô nhập mã giảm giá --}}
                        <div class="mb-3">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Mã giảm giá</label>
                            <div class="input-group">
                                <input type="text" id="voucherInput" class="form-control bg-transparent text-white border-secondary text-uppercase"
                                       placeholder="Nhập mã voucher..." autocomplete="off">
                                <button type="button" class="btn btn-outline-secondary text-white" id="btnApplyVoucher">
                                    <i class="fa-solid fa-tag me-1"></i>Áp dụng
                                </button>
                            </div>
                            <div id="voucherMessage" class="mt-2 small" style="display:none;"></div>
                        </div>

                        {{-- Tổng tiền gốc --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary small">Tạm tính:</span>
                            <span class="text-white small" id="checkoutSubTotal">0đ</span>
                        </div>

                        {{-- Dòng giảm giá (ẩn khi chưa áp dụng) --}}
                        <div class="d-flex justify-content-between align-items-center mb-2" id="discountRow" style="display:none !important;">
                            <span class="text-secondary small">Giảm giá (<span id="discountLabel"></span>):</span>
                            <span class="text-success small fw-bold" id="discountAmount">-0đ</span>
                        </div>

                        {{-- Tổng thanh toán cuối --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 pt-2 border-top border-secondary border-opacity-25">
                            <h5 class="mb-0 text-white playfair">Tổng thanh toán:</h5>
                            <h4 class="mb-0 text-gold fw-bold playfair" id="checkoutTotalPrice">0đ</h4>
                        </div>
                        
                        <!-- Dữ liệu giỏ hàng (hidden) để gửi lên server -->
                        <input type="hidden" name="cart_data" id="cartDataInput">
                        <input type="hidden" name="ma_giam_gia" id="maGiamGiaInput">

                        <button type="submit" class="btn btn-lux w-100 py-3 text-uppercase tracking-widest" id="btnPlaceOrder">Xác nhận đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const cart          = JSON.parse(localStorage.getItem('cart') || '[]');
            const container     = document.getElementById('checkoutCartItems');
            const subTotalEl    = document.getElementById('checkoutSubTotal');
            const totalEl       = document.getElementById('checkoutTotalPrice');
            const dataInput     = document.getElementById('cartDataInput');
            const discountRow   = document.getElementById('discountRow');
            const discountAmt   = document.getElementById('discountAmount');
            const discountLbl   = document.getElementById('discountLabel');
            const maGiamGiaInput = document.getElementById('maGiamGiaInput');

            const fmt = n => new Intl.NumberFormat('vi-VN').format(n) + 'đ';

            // Lọc sản phẩm được chọn
            const selectedCart = cart.filter(item => item.selected !== false);

            if (selectedCart.length === 0) {
                container.innerHTML = '<div class="text-center py-4 text-muted">Không có sản phẩm nào được chọn để thanh toán.</div>';
                document.getElementById('btnPlaceOrder').disabled = true;
                return;
            }

            let html       = '';
            let subTotal   = 0;
            let soTienGiam = 0;

            selectedCart.forEach(item => {
                subTotal += item.price * item.quantity;
                html += `
                    <div class="d-flex align-items-center mb-3">
                        <img src="${item.img}" width="60" class="img-thumbnail bg-transparent border-secondary border-opacity-50 me-3 object-fit-cover" style="aspect-ratio: 1/1;">
                        <div class="flex-grow-1">
                            <h6 class="small mb-1 text-white">${item.name}</h6>
                            <div class="d-flex align-items-center">
                                <span class="text-white opacity-75" style="font-size: 0.7rem;">Số lượng: ${item.quantity}</span>
                                <span class="mx-2 text-secondary">|</span>
                                <span class="text-secondary" style="font-size: 0.7rem;">${fmt(item.price)}</span>
                            </div>
                        </div>
                        <div class="text-gold small fw-bold">${fmt(item.price * item.quantity)}</div>
                    </div>`;
            });

            container.innerHTML = html;
            dataInput.value     = JSON.stringify(selectedCart);

            // Hàm cập nhật tổng tiền
            function capNhatTong() {
                const finalTotal = Math.max(0, subTotal - soTienGiam);
                subTotalEl.textContent = fmt(subTotal);
                totalEl.textContent    = fmt(finalTotal);
            }
            capNhatTong();

            // Xử lý nút Áp dụng voucher
            document.getElementById('btnApplyVoucher').addEventListener('click', function() {
                const maCode = document.getElementById('voucherInput').value.trim();
                const msgEl  = document.getElementById('voucherMessage');

                if (!maCode) {
                    msgEl.style.display = '';
                    msgEl.className     = 'mt-2 small text-warning';
                    msgEl.textContent   = 'Vui lòng nhập mã giảm giá.';
                    return;
                }

                // Gọi AJAX kiểm tra voucher
                fetch('{{ route("user.kiemtravoucher") }}', {
                    method : 'POST',
                    headers: {
                        'Content-Type'     : 'application/json',
                        'X-CSRF-TOKEN'     : '{{ csrf_token() }}',
                        'Accept'           : 'application/json',
                    },
                    body: JSON.stringify({ ma_giam_gia: maCode, tong_tien: subTotal })
                })
                .then(r => r.json())
                .then(data => {
                    msgEl.style.display = '';
                    if (data.hop_le) {
                        soTienGiam = data.so_tien_giam;
                        maGiamGiaInput.value = maCode.toUpperCase();

                        // Hiện dòng giảm giá
                        discountRow.style.display = 'flex';
                        discountLbl.textContent   = data.ten_voucher;
                        discountAmt.textContent   = '-' + data.so_tien_giam_format;

                        msgEl.className   = 'mt-2 small text-success';
                        msgEl.innerHTML   = '<i class="fa-solid fa-circle-check me-1"></i>' + data.thong_bao;

                        document.getElementById('btnApplyVoucher').disabled  = true;
                        document.getElementById('voucherInput').readOnly     = true;
                    } else {
                        soTienGiam = 0;
                        maGiamGiaInput.value      = '';
                        discountRow.style.display = 'none';

                        msgEl.className = 'mt-2 small text-danger';
                        msgEl.innerHTML = '<i class="fa-solid fa-circle-xmark me-1"></i>' + data.thong_bao;
                    }
                    capNhatTong();
                })
                .catch(() => {
                    msgEl.style.display = '';
                    msgEl.className     = 'mt-2 small text-danger';
                    msgEl.textContent   = 'Lỗi kết nối. Vui lòng thử lại.';
                });
            });

        } catch (e) {
            console.log(e);
        }
    });
</script>
@endpush
