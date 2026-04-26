@extends('layouts.frontend')
@section('title', 'Tuyển dụng')

@section('content')
<!-- Hero Section -->
<div class="position-relative overflow-hidden bg-dark py-5" style="min-height: 400px; display: flex; align-items: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background: url('https://images.unsplash.com/photo-1542435503-956c469947f6?q=80&w=2000') center/cover no-repeat;"></div>
    <div class="container position-relative z-1 animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h5 class="text-gold tracking-widest text-uppercase mb-3">Gia nhập đội ngũ</h5>
                <h1 class="display-3 playfair text-white fw-bold mb-4">Kiến Tạo Tương Lai Cùng Tech VinaShop</h1>
                <p class="lead text-secondary mb-0">Chúng tôi không chỉ bán đồng hồ, chúng tôi trao gửi những giá trị vượt thời gian.</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 mt-5">
    <!-- Why Join Us -->
    <div class="row g-5 mb-5 pb-5">
        <div class="col-md-4 text-center animate__animated animate__fadeInUp">
            <div class="mb-4">
                <i class="fa-solid fa-gem text-gold display-4"></i>
            </div>
            <h4 class="playfair text-white mb-3">Môi trường chuyên nghiệp</h4>
            <p class="text-secondary small">Làm việc trong không gian showroom đẳng cấp 5 sao với những thương hiệu đồng hồ hàng đầu thế giới.</p>
        </div>
        <div class="col-md-4 text-center animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="mb-4">
                <i class="fa-solid fa-chart-line text-gold display-4"></i>
            </div>
            <h4 class="playfair text-white mb-3">Lộ trình thăng tiến</h4>
            <p class="text-secondary small">Đào tạo chuyên sâu về kiến thức đồng hồ và kỹ năng quản lý, cơ hội phát triển nghề nghiệp rõ ràng.</p>
        </div>
        <div class="col-md-4 text-center animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="mb-4">
                <i class="fa-solid fa-hand-holding-dollar text-gold display-4"></i>
            </div>
            <h4 class="playfair text-white mb-3">Đãi ngộ xứng tầm</h4>
            <p class="text-secondary small">Mức lương cạnh tranh, thưởng doanh số hấp dẫn và đầy đủ các chế độ phúc lợi cao cấp.</p>
        </div>
    </div>

    <!-- Job Listings -->
    <div class="mb-5 animate__animated animate__fadeIn">
        <h3 class="playfair text-white mb-5 border-bottom border-gold border-opacity-25 pb-3">Vị Trí Đang Tuyển Dụng</h3>
        
        <div class="row g-4">
            <!-- Job Item 1 -->
            <div class="col-12">
                <div class="job-card bg-dark border border-secondary border-opacity-25 p-4 transition-all hover-gold-border">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="text-white mb-1">Chuyên Viên Tư Vấn Đồng Hồ Cao Cấp</h5>
                            <div class="d-flex gap-3 text-secondary small">
                                <span><i class="fa-solid fa-location-dot me-2"></i>TP. Hồ Chí Minh</span>
                                <span><i class="fa-solid fa-briefcase me-2"></i>Toàn thời gian</span>
                                <span><i class="fa-solid fa-money-bill-wave me-2"></i>Thỏa thuận</span>
                            </div>
                        </div>
                        <div class="col-md-3 text-md-center mt-3 mt-md-0">
                            <span class="text-secondary small">Hạn nộp: 30/05/2026</span>
                        </div>
                        <div class="col-md-3 text-md-end mt-3 mt-md-0">
                            <button class="btn btn-outline-gold px-4 py-2 text-uppercase tracking-widest small">Ứng tuyển ngay</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Item 2 -->
            <div class="col-12">
                <div class="job-card bg-dark border border-secondary border-opacity-25 p-4 transition-all hover-gold-border">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="text-white mb-1">Kỹ Thuật Viên Sửa Chữa Đồng Hồ (Thợ Cả)</h5>
                            <div class="d-flex gap-3 text-secondary small">
                                <span><i class="fa-solid fa-location-dot me-2"></i>TP. Hà Nội</span>
                                <span><i class="fa-solid fa-briefcase me-2"></i>Toàn thời gian</span>
                                <span><i class="fa-solid fa-money-bill-wave me-2"></i>15M - 25M</span>
                            </div>
                        </div>
                        <div class="col-md-3 text-md-center mt-3 mt-md-0">
                            <span class="text-secondary small">Hạn nộp: 15/05/2026</span>
                        </div>
                        <div class="col-md-3 text-md-end mt-3 mt-md-0">
                            <button class="btn btn-outline-gold px-4 py-2 text-uppercase tracking-widest small">Ứng tuyển ngay</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Item 3 -->
            <div class="col-12">
                <div class="job-card bg-dark border border-secondary border-opacity-25 p-4 transition-all hover-gold-border">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="text-white mb-1">Quản Lý Showroom (Store Manager)</h5>
                            <div class="d-flex gap-3 text-secondary small">
                                <span><i class="fa-solid fa-location-dot me-2"></i>Đà Nẵng</span>
                                <span><i class="fa-solid fa-briefcase me-2"></i>Toàn thời gian</span>
                                <span><i class="fa-solid fa-money-bill-wave me-2"></i>Cạnh tranh</span>
                            </div>
                        </div>
                        <div class="col-md-3 text-md-center mt-3 mt-md-0">
                            <span class="text-secondary small">Hạn nộp: 20/05/2026</span>
                        </div>
                        <div class="col-md-3 text-md-end mt-3 mt-md-0">
                            <button class="btn btn-outline-gold px-4 py-2 text-uppercase tracking-widest small">Ứng tuyển ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact CTA -->
    <div class="mt-5 py-5 bg-gold text-black text-center animate__animated animate__zoomIn">
        <h4 class="playfair fw-bold mb-3">Bạn không tìm thấy vị trí phù hợp?</h4>
        <p class="mb-4">Hãy gửi CV của bạn cho chúng tôi, Tech VinaShop luôn chào đón những nhân tài đam mê đồng hồ.</p>
        <a href="mailto:hr@techvinashop.vn" class="btn btn-dark px-5 py-3 text-uppercase tracking-widest fw-bold">Gửi CV ứng tuyển tự do</a>
    </div>
</div>

<style>
    .hover-gold-border:hover { border-color: #d4af37 !important; transform: translateX(10px); }
    .job-card { cursor: pointer; }
</style>
@endsection
