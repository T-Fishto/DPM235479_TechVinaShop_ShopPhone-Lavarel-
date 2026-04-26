<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5">
                <h5 class="footer-title">TECH VINASHOP</h5>
                <p class="text-lux-gray small" style="line-height: 1.8;">Kể từ năm 1992, chúng tôi đã tận tâm tìm kiếm và cung cấp những cỗ máy thời gian tinh xảo nhất từ Thụy Sĩ đến với giới mộ điệu Việt Nam. Mỗi chiếc đồng hồ là một tác phẩm nghệ thuật.</p>
            </div>
            <div class="col-lg-2 offset-lg-1 mb-5">
                <h5 class="footer-title">Liên kết</h5>
                <a href="{{ route('frontend.sanpham') }}" class="footer-link">Sản phẩm</a>
                <a href="{{ route('frontend.thuonghieu') }}" class="footer-link">Thương hiệu</a>
                <a href="{{ route('frontend.baiviet') }}" class="footer-link">Bài viết</a>
            </div>
            <div class="col-lg-2 mb-5">
                <h5 class="footer-title">Hỗ trợ</h5>
                <a href="{{ route('frontend.tuyendung') }}" class="footer-link">Tuyển dụng</a>
                <a href="{{ route('frontend.lienhe') }}" class="footer-link">Liên hệ</a>
                <a href="#" class="footer-link">Đổi trả</a>
            </div>
            <div class="col-lg-3 mb-5">
                <h5 class="footer-title">Theo dõi tin tức</h5>
                <form class="d-flex">
                    <input type="email" class="form-control newsletter-input" placeholder="Email...">
                    <button class="btn btn-lux px-3" type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        <hr class="border-secondary opacity-25">
        <div class="text-center pt-4 small text-lux-gray">
            &copy; {{ date('Y') }} Tech VinaShop. All Rights Reserved.
        </div>
    </div>
</footer>
