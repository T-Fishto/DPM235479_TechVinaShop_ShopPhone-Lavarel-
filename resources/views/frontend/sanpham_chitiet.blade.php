@extends('layouts.frontend')
@section('title', $sanpham->tensanpham)

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-5 animate__animated animate__fadeIn">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-secondary text-decoration-none hover-gold transition-all">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.sanpham.theoloai', $sanpham->LoaiSanPham->tenloai_slug ?? '') }}" class="text-secondary text-decoration-none hover-gold transition-all">{{ $sanpham->LoaiSanPham->tenloai ?? 'Sản phẩm' }}</a></li>
            <li class="breadcrumb-item active text-gold" aria-current="page">{{ $sanpham->tensanpham }}</li>
        </ol>
    </nav>

    <div class="row g-5 mb-5">
        <!-- Product Image -->
        <div class="col-md-6 col-lg-5 animate__animated animate__fadeInLeft">
            <div class="product-gallery position-sticky" style="top: 100px;">
                <div class="main-image-container border border-secondary border-opacity-25 p-1 mb-3 position-relative overflow-hidden bg-dark">
                    @if($sanpham->hinhanh)
                        <img src="{{ asset('uploads/sanpham/' . $sanpham->hinhanh) }}" class="img-fluid w-100 object-fit-cover" alt="{{ $sanpham->tensanpham }}" id="mainProductImage" style="aspect-ratio: 1/1;">
                    @else
                        <div class="d-flex align-items-center justify-content-center w-100 bg-secondary bg-opacity-10" style="aspect-ratio: 1/1;">
                            <i class="fa-solid fa-clock text-secondary" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                    @if($sanpham->soluong <= 0)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-0 px-3 py-2 text-uppercase tracking-widest">Hết hàng</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6 col-lg-7 animate__animated animate__fadeInRight">
            <div class="product-details ps-lg-4">
                <div class="d-flex align-items-center mb-2">
                    <span class="text-gold text-uppercase tracking-widest small fw-bold">{{ $sanpham->HangSanXuat->tenhang ?? 'Thương hiệu' }}</span>
                </div>
                
                <h1 class="display-5 playfair fw-bold mb-3 text-white">{{ $sanpham->tensanpham }}</h1>
                
                <div class="price-block mb-4 border-bottom border-secondary border-opacity-25 pb-4">
                    <div class="d-flex align-items-baseline gap-3">
                        <span class="fs-2 text-white fw-bold playfair">{{ number_format($sanpham->dongia, 0, ',', '.') }}<span class="fs-4 text-gold ms-1">₫</span></span>
                    </div>
                </div>

                <div class="product-meta mb-4">
                    <div class="row g-3 text-secondary small">
                        <div class="col-6">
                            <i class="fa-solid fa-layer-group text-gold me-2"></i> Phân loại: <span class="text-white">{{ $sanpham->LoaiSanPham->tenloai ?? 'Đang cập nhật' }}</span>
                        </div>
                        <div class="col-6">
                            <i class="fa-solid fa-box-open text-gold me-2"></i> Tình trạng: 
                            @if($sanpham->soluong > 0)
                                <span class="text-success"><i class="fa-solid fa-check-circle me-1"></i>Còn hàng ({{ $sanpham->soluong }})</span>
                            @else
                                <span class="text-danger"><i class="fa-solid fa-xmark-circle me-1"></i>Hết hàng</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="product-description mb-5 text-secondary" style="line-height: 1.8;">
                    {!! nl2br(e($sanpham->motasanpham ?? 'Chưa có thông tin mô tả cho sản phẩm này.')) !!}
                </div>

                @if($sanpham->soluong > 0)
                    <div class="purchase-actions d-flex gap-3 align-items-stretch">
                        <div class="quantity-selector border border-secondary border-opacity-50 d-flex align-items-center px-3 bg-dark">
                            <button type="button" class="btn btn-link text-white text-decoration-none p-0" onclick="decreaseQty()">
                                <i class="fa-solid fa-minus fs-sm"></i>
                            </button>
                            <input type="number" id="buyQuantity" class="form-control bg-transparent border-0 text-center text-white fw-bold shadow-none" value="1" min="1" max="{{ $sanpham->soluong }}" style="width: 60px;">
                            <button type="button" class="btn btn-link text-white text-decoration-none p-0" onclick="increaseQty()">
                                <i class="fa-solid fa-plus fs-sm"></i>
                            </button>
                        </div>
                        <button type="button" class="btn btn-lux flex-grow-1 text-uppercase tracking-widest py-3 add-to-cart-detail"
                                data-id="{{ $sanpham->id }}" 
                                data-name="{{ $sanpham->tensanpham }}" 
                                data-price="{{ $sanpham->dongia }}"
                                data-stock="{{ $sanpham->soluong }}"
                                data-img="{{ $sanpham->hinhanh ? asset('uploads/sanpham/' . $sanpham->hinhanh) : '' }}">
                            <i class="fa-solid fa-bag-shopping me-2"></i> Thêm vào giỏ
                        </button>
                    </div>
                @else
                    <button type="button" class="btn btn-outline-secondary w-100 py-3 text-uppercase tracking-widest" disabled>
                        <i class="fa-solid fa-bell-slash me-2"></i> Sản phẩm tạm hết
                    </button>
                @endif
                
                <!-- Guarantee Policies -->
                <div class="mt-5 p-4 border border-secondary border-opacity-25 bg-dark">
                    <div class="row g-3">
                        <div class="col-12 col-sm-4 text-center">
                            <i class="fa-solid fa-shield-halved text-gold fs-3 mb-2"></i>
                            <p class="mb-0 small text-white">Bảo hành 5 năm</p>
                        </div>
                        <div class="col-12 col-sm-4 text-center border-start border-end border-secondary border-opacity-25">
                            <i class="fa-solid fa-award text-gold fs-3 mb-2"></i>
                            <p class="mb-0 small text-white">Chính hãng 100%</p>
                        </div>
                        <div class="col-12 col-sm-4 text-center">
                            <i class="fa-solid fa-truck-fast text-gold fs-3 mb-2"></i>
                            <p class="mb-0 small text-white">Giao hàng hỏa tốc</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Reviews Section -->
    <div class="product-reviews mt-5 pt-5 border-top border-secondary border-opacity-25 animate__animated animate__fadeInUp">
        <div class="row">
            <!-- Sidebar: Rating Summary & Form -->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h3 class="playfair fw-bold text-white mb-4">Đánh giá & Bình luận</h3>
                
                <div class="bg-dark p-4 border border-secondary border-opacity-25 rounded-0 text-center mb-4">
                    @php
                        $avgRating = $sanpham->DanhGia->avg('diem') ?? 0;
                        $reviewCount = $sanpham->DanhGia->count();
                    @endphp
                    <div class="display-4 fw-bold text-gold playfair mb-1">{{ number_format($avgRating, 1) }}</div>
                    <div class="stars mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= round($avgRating) ? 'text-gold' : 'text-secondary opacity-25' }}"></i>
                        @endfor
                    </div>
                    <p class="text-secondary small mb-0">{{ $reviewCount }} lượt đánh giá</p>
                </div>

                @auth
                    <div class="card bg-dark border-secondary border-opacity-25 rounded-0">
                        <div class="card-body p-4">
                            <h5 class="text-gold tracking-widest text-uppercase mb-3 small">Gửi đánh giá của bạn</h5>
                            <form action="{{ route('user.danhgia', ['tensanpham_slug' => $sanpham->tensanpham_slug]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-white small opacity-75">Mức độ hài lòng:</label>
                                    <select name="diem" class="form-select bg-dark text-white border-secondary border-opacity-50 shadow-none">
                                        <option value="5">★★★★★ (5 Sao)</option>
                                        <option value="4">★★★★☆ (4 Sao)</option>
                                        <option value="3">★★★☆☆ (3 Sao)</option>
                                        <option value="2">★★☆☆☆ (2 Sao)</option>
                                        <option value="1">★☆☆☆☆ (1 Sao)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea name="noidung" class="form-control bg-dark text-white border-secondary border-opacity-50 shadow-none" rows="4" placeholder="Mời bạn chia sẻ cảm nhận về sản phẩm..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-lux w-100 py-3 text-uppercase tracking-widest small">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="p-4 border border-secondary border-opacity-25 bg-dark text-center">
                        <p class="text-white small mb-3">Vui lòng đăng nhập để bình luận về sản phẩm này.</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-gold btn-sm px-4 text-uppercase tracking-widest small">Đăng nhập ngay</a>
                    </div>
                @endauth
            </div>

            <!-- Review List -->
            <div class="col-lg-8">
                <div class="reviews-list ps-lg-4">
                    @if($sanpham->DanhGia->count() > 0)
                        @foreach($sanpham->DanhGia as $dg)
                            <div class="review-item pb-4 mb-4 border-bottom border-secondary border-opacity-10">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            @if($dg->User && $dg->User->hinhanh)
                                                <img src="{{ asset('uploads/profile/' . $dg->User->hinhanh) }}" class="rounded-circle object-fit-cover border border-secondary border-opacity-50" width="45" height="45">
                                            @else
                                                <div class="rounded-circle bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center border border-secondary border-opacity-50" style="width: 45px; height: 45px;">
                                                    <i class="fa-solid fa-user text-secondary"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-0 small fw-bold">{{ $dg->User->name ?? 'Khách hàng' }}
                                                <span class="text-success ms-2" style="font-size: 0.65rem;"><i class="fa-solid fa-circle-check"></i> Đã mua tại shop</span>
                                            </h6>
                                            <div class="stars" style="font-size: 0.7rem;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $dg->diem ? 'text-gold' : 'text-secondary opacity-25' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-secondary small opacity-50">{{ $dg->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="review-content ps-5 ms-1">
                                    <p class="text-secondary small mb-2 lh-lg">{{ $dg->noidung }}</p>
                                    
                                    <form action="{{ route('user.danhgia.tim', ['id' => $dg->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 text-decoration-none small hover-gold transition-all" style="font-size: 0.75rem;">
                                            @php
                                                $isLiked = Auth::check() && $dg->Tims->where('user_id', Auth::id())->count() > 0;
                                            @endphp
                                            <i class="{{ $isLiked ? 'fa-solid text-danger' : 'fa-regular text-secondary' }} fa-heart me-1"></i>
                                            <span class="{{ $isLiked ? 'text-danger fw-bold' : 'text-secondary' }}">
                                                {{ $dg->Tims->count() > 0 ? $dg->Tims->count() : '' }} Hữu ích
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 border border-secondary border-opacity-25 bg-dark bg-opacity-25">
                            <i class="fa-solid fa-comments text-secondary opacity-25 fs-1 mb-3"></i>
                            <p class="text-secondary mb-0">Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($sanphamCungLoai->count() > 0)
    <div class="related-products mt-5 pt-5 border-top border-secondary border-opacity-25 animate__animated animate__fadeInUp">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h5 class="text-gold tracking-widest text-uppercase mb-1 small">Cùng bộ sưu tập</h5>
                <h3 class="playfair fw-bold text-white mb-0">Sản Phẩm Tương Tự</h3>
            </div>
            <a href="#" class="btn btn-link text-gold text-decoration-none hover-white transition-all d-none d-sm-block">Xem tất cả <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
        
        <div class="row g-4">
            @foreach($sanphamCungLoai as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card position-relative overflow-hidden h-100 bg-dark">
                    <div class="card-img-container">
                        @if($item->hinhanh)
                            <img src="{{ asset('uploads/sanpham/' . $item->hinhanh) }}" class="img-fluid w-100 object-fit-cover" alt="{{ $item->tensanpham }}" style="aspect-ratio: 1/1;">
                        @else
                            <div class="bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center w-100" style="aspect-ratio: 1/1;">
                                <i class="fa-solid fa-clock text-secondary" style="font-size: 3rem;"></i>
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
                            <a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $item->LoaiSanPham->tenloai_slug ?? 'loai', 'tensanpham_slug' => $item->tensanpham_slug]) }}" class="btn btn-outline-light btn-sm small tracking-widest">Xem chi tiết</a>
                        </div>
                    </div>
                    
                    <div class="p-3 text-center">
                        <small class="text-gold text-uppercase tracking-widest mb-1 d-block" style="font-size: 0.7rem;">{{ $item->HangSanXuat->tenhang ?? 'Thương hiệu' }}</small>
                        <h6 class="mb-2 text-white text-truncate">{{ $item->tensanpham }}</h6>
                        <span class="fw-bold d-block playfair" style="color: #bbb;">{{ number_format($item->dongia, 0, ',', '.') }}<span class="text-gold ms-1">₫</span></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

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

