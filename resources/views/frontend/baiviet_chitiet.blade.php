@extends('layouts.frontend')
@section('title', $baiviet->tieude)

@section('content')
<article class="py-5">
    <div class="container mb-4">
        <nav aria-label="breadcrumb" class="animate__animated animate__fadeIn">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}" class="text-secondary text-decoration-none hover-gold transition-all">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.baiviet') }}" class="text-secondary text-decoration-none hover-gold transition-all">Bài viết</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.baiviet.theochude', ['tenchude_slug' => $baiviet->ChuDe->tenchude_slug]) }}" class="text-secondary text-decoration-none hover-gold transition-all">{{ $baiviet->ChuDe->tenchude }}</a></li>
                <li class="breadcrumb-item active text-gold" aria-current="page">{{ $baiviet->tieude }}</li>
            </ol>
        </nav>
    </div>
    <!-- Header -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <a href="{{ route('frontend.baiviet.theochude', ['tenchude_slug' => $baiviet->ChuDe->tenchude_slug]) }}" class="text-gold text-decoration-none small text-uppercase tracking-widest mb-3 d-block">{{ $baiviet->ChuDe->tenchude }}</a>
                <h1 class="display-4 playfair fw-bold text-white mb-4 animate__animated animate__fadeInDown">{{ $baiviet->tieude }}</h1>
                <div class="d-flex align-items-center justify-content-center text-secondary small opacity-75 animate__animated animate__fadeInUp">
                    <span class="mx-3"><i class="fa-solid fa-user-pen text-gold me-2"></i>{{ $baiviet->User->name }}</span>
                    <span class="mx-3"><i class="fa-solid fa-calendar-days text-gold me-2"></i>{{ $baiviet->created_at->format('d/m/Y') }}</span>
                    <span class="mx-3"><i class="fa-solid fa-eye text-gold me-2"></i>{{ $baiviet->luotxem }} lượt xem</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    @if($baiviet->hinhanh)
    <div class="container-fluid px-0 mb-5 animate__animated animate__fadeIn">
        <div class="featured-image-container overflow-hidden" style="max-height: 600px;">
            <img src="{{ asset('uploads/baiviet/' . $baiviet->hinhanh) }}" class="w-100 object-fit-cover" style="height: 60vh;" alt="{{ $baiviet->tieude }}">
        </div>
    </div>
    @endif

    <!-- Content -->
    <div class="container mb-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate__animated animate__fadeInUp">
                <!-- Summary -->
                <div class="lead text-gold mb-5 fw-light playfair fst-italic" style="border-left: 3px solid #d4af37; padding-left: 25px;">
                    {{ $baiviet->tomtat }}
                </div>

                <!-- Main Text -->
                <div class="article-body text-secondary lh-lg" style="font-size: 1.1rem;">
                    {!! $baiviet->noidung !!}
                </div>

                <!-- Social Share -->
                <div class="mt-5 pt-5 border-top border-secondary border-opacity-25 d-flex align-items-center gap-3">
                    <span class="text-white small text-uppercase tracking-widest">Chia sẻ bài viết:</span>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-link"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Articles -->
    @if($baivietCungChude->count() > 0)
    <div class="bg-dark py-5 border-top border-secondary border-opacity-25 mt-5">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h5 class="text-gold tracking-widest text-uppercase mb-1 small">Xem tiếp</h5>
                    <h3 class="playfair fw-bold text-white mb-0">Bài Viết Cùng Chủ Đề</h3>
                </div>
                <a href="{{ route('frontend.baiviet.theochude', ['tenchude_slug' => $baiviet->ChuDe->tenchude_slug]) }}" class="btn btn-link text-gold text-decoration-none hover-white transition-all">Xem tất cả <i class="fa-solid fa-arrow-right ms-2"></i></a>
            </div>

            <div class="row g-4">
                @foreach($baivietCungChude as $item)
                <div class="col-md-4">
                    <div class="related-blog-card h-100 position-relative overflow-hidden group">
                        <div class="overflow-hidden mb-3">
                            @if($item->hinhanh)
                                <img src="{{ asset('uploads/baiviet/' . $item->hinhanh) }}" class="img-fluid w-100 transition-all hover-zoom" style="aspect-ratio: 3/2; object-fit: cover;" alt="{{ $item->tieude }}">
                            @else
                                <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center w-100" style="aspect-ratio: 3/2;">
                                    <i class="fa-solid fa-newspaper text-secondary fs-3"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="h6 playfair fw-bold mb-0">
                            <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $item->ChuDe->tenchude_slug, 'tieude_slug' => $item->tieude_slug]) }}" class="text-white text-decoration-none hover-gold transition-all line-clamp-2">
                                {{ $item->tieude }}
                            </a>
                        </h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</article>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}">
@endpush
