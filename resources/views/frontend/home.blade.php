@extends('layouts.frontend')
@section('title', 'Đỉnh cao cơ khí Thụy Sĩ')

@section('content')
<!-- Hero Section (Slider) -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" style="height: 90vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1547996160-81dfa63595aa?q=80&w=1974&auto=format&fit=crop') center/cover;">
            <div class="carousel-caption d-md-block text-start h-100" style="top: 35%;">
                <div class="container">
                    <h5 class="animate__animated animate__fadeInDown text-gold tracking-widest text-uppercase">Sưu tập giới hạn 2024</h5>
                    <h1 class="animate__animated animate__fadeInDown animate__delay-1s display-2 playfair fw-bold mb-4">Precision & Prestige</h1>
                    <p class="animate__animated animate__fadeInUp animate__delay-1s lead mb-5 max-w-lg">Khám phá tinh hoa chế tác đồng hồ qua từng đường nét cơ khí chuẩn xác.</p>
                    <a href="#products" class="btn btn-lux px-5 py-3 animate__animated animate__zoomIn animate__delay-2s">Khám phá ngay</a>
                </div>
            </div>
        </div>
        <div class="carousel-item" style="height: 90vh; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?q=80&w=2070&auto=format&fit=crop') center/cover;">
            <div class="carousel-caption d-md-block text-center h-100" style="top: 35%;">
                <div class="container">
                    <h5 class="text-gold tracking-widest text-uppercase">Đẳng cấp quý ông</h5>
                    <h1 class="display-2 playfair fw-bold mb-4">Timeless Elegance</h1>
                    <p class="lead mb-5">Biểu tượng của sự thành đạt và gu thẩm mỹ tinh tế.</p>
                    <a href="#products" class="btn btn-lux px-5 py-3">Mua sắm bộ sưu tập</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Brands Scroll -->
<div class="py-5 bg-dark border-bottom border-secondary opacity-50">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center opacity-75 grayscale flex-wrap">
            @foreach($hangsanxuat as $hang)
                <span class="px-4 py-2 text-white playfair h4 mb-0">{{ $hang->tenhang }}</span>
            @endforeach
        </div>
    </div>
</div>

<!-- Product Showcase -->
<section id="products" class="py-5 mt-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 playfair text-gold">Sản Phẩm Nổi Bật</h2>
            <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
        </div>

        <div class="row g-4">
            @foreach($sanpham as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card position-relative overflow-hidden h-100">
                    <div class="card-img-container">
                        @if($item->hinhanh)
                            <img src="{{ asset('uploads/sanpham/' . $item->hinhanh) }}" class="img-fluid" alt="{{ $item->tensanpham }}">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 300px;">
                                <i class="fa-solid fa-clock text-dark" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        @if($item->soluong <= 0)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2 rounded-0 px-2 py-1 text-uppercase" style="font-size: 0.7rem;">Hết hàng</span>
                        @endif
                        
                        <div class="product-overlay d-flex flex-column justify-content-center align-items-center">
                            @if($item->soluong > 0)
                            <button class="btn btn-lux mb-2 add-to-cart" 
                                    data-id="{{ $item->id }}" 
                                    data-name="{{ $item->tensanpham }}" 
                                    data-price="{{ $item->dongia }}"
                                    data-stock="{{ $item->soluong }}"
                                    data-img="{{ $item->hinhanh ? asset('uploads/sanpham/' . $item->hinhanh) : '' }}">
                                <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                            @else
                            <button class="btn btn-outline-danger mb-2" disabled>
                                <i class="fa-solid fa-bell-slash"></i> Hết hàng
                            </button>
                            @endif
                            <a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $item->LoaiSanPham->tenloai_slug ?? 'san-pham', 'tensanpham_slug' => $item->tensanpham_slug]) }}" class="btn btn-outline-light btn-sm small tracking-widest">Xem chi tiết</a>
                        </div>
                    </div>
                    
                    <div class="p-3 text-center">
                        <small class="text-gold text-uppercase tracking-widest mb-1 d-block">{{ $item->HangSanXuat->tenhang }}</small>
                        <h6 class="mb-2">{{ $item->tensanpham }}</h6>
                        <span class="fw-bold d-block" style="color: #bbb;">{{ number_format($item->dongia, 0, ',', '.') }}đ</span>
                    </div>
                    
                    @if($loop->index < 4)
                        <span class="badge position-absolute top-0 end-0 m-3 bg-gold text-black rounded-0">NEW</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
 
<!-- Store Offers & Utilities -->
<section class="py-5 bg-dark border-top border-secondary border-opacity-25 animate__animated animate__fadeIn">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h5 class="text-gold tracking-widest text-uppercase mb-1 small">Giá trị cốt lõi</h5>
            <h2 class="display-5 playfair text-white fw-bold">Ưu đãi - Tiện ích tại cửa hàng</h2>
            <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
        </div>
        
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="offers-content pe-lg-5">
                    <div class="offer-item mb-5 d-flex align-items-start">
                        <div class="offer-icon me-4 mt-1 border border-gold border-opacity-50 p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-shield-halved text-gold fs-4"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-2 fw-bold">Cam kết 100% hàng chính hãng</h5>
                            <p class="text-secondary small mb-0 lh-lg">Đền ngay 1 tỷ đồng nếu phát hiện hàng giả - hàng nhái. Mỗi sản phẩm bán ra đều đi kèm đầy đủ giấy tờ chứng nhận và phụ kiện chính hãng từ nhà sản xuất.</p>
                        </div>
                    </div>
                    
                    <div class="offer-item mb-5 d-flex align-items-start">
                        <div class="offer-icon me-4 mt-1 border border-gold border-opacity-50 p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-truck-fast text-gold fs-4"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-2 fw-bold">Miễn phí vận chuyển toàn quốc</h5>
                            <p class="text-secondary small mb-0 lh-lg">Hệ thống giao hàng hỏa tốc (COD) hoàn toàn miễn phí trên toàn lãnh thổ Việt Nam. Nhận hàng, kiểm tra và thanh toán ngay tại nhà cực kỳ an tâm.</p>
                        </div>
                    </div>
                    
                    <div class="offer-item mb-5 d-flex align-items-start">
                        <div class="offer-icon me-4 mt-1 border border-gold border-opacity-50 p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-arrows-rotate text-gold fs-4"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-2 fw-bold">Chính sách 1 đổi 1 trong 7 ngày</h5>
                            <p class="text-secondary small mb-0 lh-lg">Hỗ trợ đổi mới hoàn toàn trong vòng 7 ngày đầu tiên nếu sản phẩm phát sinh lỗi từ phía nhà sản xuất. Quy trình xử lý nhanh chóng, minh bạch.</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 border border-gold border-opacity-50 position-relative overflow-hidden" style="background: rgba(212, 175, 55, 0.05);">
                        <i class="fa-solid fa-headset position-absolute end-0 bottom-0 text-gold opacity-10" style="font-size: 5rem; transform: translate(20px, 20px);"></i>
                        <p class="text-gold mb-1 small tracking-widest text-uppercase">Liên hệ hỗ trợ ngay</p>
                        <h3 class="text-white playfair mb-0 fw-bold">1800.6005</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="store-image-wrapper position-relative p-2 border border-secondary border-opacity-25">
                    <img src="{{ asset('frontend/images/store.png') }}" class="img-fluid w-100 shadow-lg grayscale-hover transition-all" alt="Tech VinaShop Store">
                    <div class="position-absolute bottom-0 end-0 bg-gold text-black p-4 m-0 d-none d-md-block shadow-lg" style="transform: translate(20px, 20px); min-width: 250px;">
                        <h4 class="playfair mb-0 fw-bold">Tech VinaShop</h4>
                        <p class="small mb-0 opacity-75">Không gian trải nghiệm đẳng cấp</p>
                        <div class="mt-2 small"><i class="fa-solid fa-location-dot me-2"></i>Hệ thống 50 cửa hàng toàn quốc</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1060">
    <div id="cartToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-check-circle me-2"></i> Đã thêm vào giỏ hàng thành công!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endsection