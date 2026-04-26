@extends('layouts.frontend')
@section('title', $tenChuDe)

@section('content')
<div class="container py-5">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <h5 class="text-gold tracking-widest text-uppercase mb-1 small">Blog & Tin tức</h5>
        <h2 class="display-5 playfair text-white fw-bold">{{ $tenChuDe }}</h2>
        <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
    </div>

    <div class="row g-5">
        <!-- Main Content -->
        <div class="col-lg-9 animate__animated animate__fadeInLeft">
            <div class="row g-4">
                @forelse($baiviet as $item)
                <div class="col-md-6">
                    <article class="blog-card h-100 bg-dark border border-secondary border-opacity-25 overflow-hidden transition-all hover-up">
                        <div class="position-relative overflow-hidden">
                            @if($item->hinhanh)
                                <img src="{{ asset('uploads/baiviet/' . $item->hinhanh) }}" class="img-fluid w-100 object-fit-cover" style="aspect-ratio: 16/9;" alt="{{ $item->tieude }}">
                            @else
                                <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center w-100" style="aspect-ratio: 16/9;">
                                    <i class="fa-solid fa-newspaper text-secondary fs-1"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-gold text-black rounded-0 px-3 py-2 text-uppercase small tracking-widest">{{ $item->ChuDe->tenchude }}</span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="d-flex align-items-center mb-3 text-secondary small opacity-75">
                                <span class="me-3"><i class="fa-solid fa-calendar-days text-gold me-2"></i>{{ $item->created_at->format('d/m/Y') }}</span>
                                <span><i class="fa-solid fa-eye text-gold me-2"></i>{{ $item->luotxem }}</span>
                            </div>
                            <h4 class="h5 playfair fw-bold mb-3">
                                <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $item->ChuDe->tenchude_slug, 'tieude_slug' => $item->tieude_slug]) }}" class="text-white text-decoration-none hover-gold transition-all line-clamp-2">
                                    {{ $item->tieude }}
                                </a>
                            </h4>
                            <p class="text-secondary small mb-4 line-clamp-3">
                                {{ $item->tomtat }}
                            </p>
                            <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $item->ChuDe->tenchude_slug, 'tieude_slug' => $item->tieude_slug]) }}" class="text-gold text-decoration-none small text-uppercase tracking-widest fw-bold">
                                Đọc thêm <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-secondary">Chưa có bài viết nào trong mục này.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $baiviet->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3 animate__animated animate__fadeInRight">
            <div class="blog-sidebar">
                <!-- Categories -->
                <div class="mb-5">
                    <h5 class="text-white playfair fw-bold mb-4 pb-2 border-bottom border-gold border-opacity-25">Chủ đề bài viết</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('frontend.baiviet') }}" class="text-secondary text-decoration-none hover-gold transition-all d-flex justify-content-between align-items-center py-2 {{ empty(request()->route('tenchude_slug')) ? 'text-gold' : '' }}">
                                <span>Tất cả</span>
                            </a>
                        </li>
                        @foreach($chude as $cd)
                        <li class="mb-2">
                            <a href="{{ route('frontend.baiviet.theochude', ['tenchude_slug' => $cd->tenchude_slug]) }}" class="text-secondary text-decoration-none hover-gold transition-all d-flex justify-content-between align-items-center py-2 {{ request()->route('tenchude_slug') == $cd->tenchude_slug ? 'text-gold' : '' }}">
                                <span>{{ $cd->tenchude }}</span>
                                <span class="badge bg-secondary bg-opacity-25 rounded-pill small">{{ $cd->BaiViet->count() }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}">
@endpush
