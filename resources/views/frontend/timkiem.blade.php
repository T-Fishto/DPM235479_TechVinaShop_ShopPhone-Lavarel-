@extends('layouts.frontend')
@section('title', 'Kết quả tìm kiếm: ' . $tuKhoa)

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center animate__animated animate__fadeInDown">
            <h2 class="display-5 playfair text-gold">Kết quả tìm kiếm</h2>
            <p class="text-secondary">Tìm thấy {{ $sanpham->total() }} sản phẩm cho từ khóa "{{ $tuKhoa }}"</p>
            <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Product Grid -->
        <div class="col-12 animate__animated animate__fadeInUp">
            <div class="row g-4">
                @forelse($sanpham as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
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
                                <a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $item->LoaiSanPham->tenloai_slug ?? 'san-pham', 'tensanpham_slug' => $item->tensanpham_slug]) }}" class="btn btn-outline-light btn-sm small tracking-widest">Xem chi tiết</a>
                            </div>
                        </div>
                        
                        <div class="p-3 text-center">
                            <small class="text-gold text-uppercase tracking-widest mb-1 d-block" style="font-size: 0.7rem;">{{ $item->HangSanXuat->tenhang ?? 'Thương hiệu' }}</small>
                            <h6 class="mb-2 text-white text-truncate" title="{{ $item->tensanpham }}">{{ $item->tensanpham }}</h6>
                            <span class="fw-bold d-block playfair" style="color: #bbb;">{{ number_format($item->dongia, 0, ',', '.') }}<span class="text-gold ms-1">₫</span></span>
                        </div>
                        @if($loop->index < 4)
                            <span class="badge position-absolute top-0 end-0 m-3 bg-gold text-black rounded-0" style="z-index: 2;">NEW</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 border border-secondary border-opacity-25 bg-dark">
                    <i class="fa-solid fa-magnifying-glass text-secondary mb-3 mt-4" style="font-size: 3rem;"></i>
                    <p class="text-white lead mb-4">Không tìm thấy sản phẩm nào khớp với từ khóa của bạn.</p>
                    <a href="{{ route('frontend.sanpham') }}" class="btn btn-lux px-4">Xem tất cả sản phẩm</a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($sanpham->hasPages())
            <div class="d-flex justify-content-center mt-5" style="filter: invert(1) hue-rotate(180deg);">
                {{ $sanpham->appends(['tu-khoa' => $tuKhoa])->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
