@extends('layouts.frontend')
@section('title', 'Liên hệ')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <h5 class="text-gold tracking-widest text-uppercase mb-1 small">Kết nối với chúng tôi</h5>
        <h2 class="display-5 playfair text-white fw-bold">Liên Hệ Tech VinaShop</h2>
        <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
    </div>

    <div class="row g-5">
        <!-- Contact Information -->
        <div class="col-lg-5 animate__animated animate__fadeInLeft">
            <div class="bg-dark p-5 border border-gold border-opacity-25 h-100">
                <h4 class="playfair text-gold mb-4">Trụ Sở Chính</h4>
                
                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <i class="fa-solid fa-location-dot text-gold fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Địa chỉ</h6>
                        <p class="text-secondary small">123 Đường Đồng Khởi, Quận 1, TP. Hồ Chí Minh</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <i class="fa-solid fa-phone-volume text-gold fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Hotline</h6>
                        <p class="text-secondary small">1800.6005 (Miễn phí)</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="me-3 mt-1">
                        <i class="fa-solid fa-envelope-open-text text-gold fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Email</h6>
                        <p class="text-secondary small">contact@techvinashop.vn</p>
                    </div>
                </div>

                <div class="d-flex mb-5">
                    <div class="me-3 mt-1">
                        <i class="fa-solid fa-clock text-gold fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Giờ mở cửa</h6>
                        <p class="text-secondary small">09:00 - 21:00 (Tất cả các ngày trong tuần)</p>
                    </div>
                </div>

                <h4 class="playfair text-gold mb-4 pt-4 border-top border-secondary border-opacity-25">Theo dõi chúng tôi</h4>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-7 animate__animated animate__fadeInRight">
            <div class="card bg-transparent border-secondary border-opacity-25 rounded-0 p-4 p-md-5">
                <h4 class="playfair text-white mb-4">Gửi tin nhắn cho chúng tôi</h4>
                <p class="text-secondary small mb-4">Nếu bạn có bất kỳ thắc mắc nào về sản phẩm hoặc dịch vụ, vui lòng để lại lời nhắn, chúng tôi sẽ phản hồi trong vòng 24 giờ.</p>
                
                <form action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Họ và tên</label>
                            <input type="text" class="form-control bg-dark border-secondary text-white shadow-none py-2" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Số điện thoại</label>
                            <input type="tel" class="form-control bg-dark border-secondary text-white shadow-none py-2" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Email</label>
                            <input type="email" class="form-control bg-dark border-secondary text-white shadow-none py-2" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-gold small text-uppercase tracking-widest">Lời nhắn của bạn</label>
                            <textarea class="form-control bg-dark border-secondary text-white shadow-none py-2" rows="5" required></textarea>
                        </div>
                        <div class="col-12 pt-3">
                            <button type="button" class="btn btn-lux w-100 py-3 text-uppercase tracking-widest">Gửi lời nhắn ngay</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="mt-5 pt-5 animate__animated animate__fadeInUp">
        <div class="ratio ratio-21x9 border border-secondary border-opacity-25 p-1 bg-dark">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.460232428359!2d106.70119857590518!3d10.776019389373115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4423403d15%3A0xe5435e9f899e438c!2zMTIzIMSQ4buTbmcgS2jhu59pLCBC4biBOZ2jDqSwgUXXhuq1uIDEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1714059000000!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
@endsection
