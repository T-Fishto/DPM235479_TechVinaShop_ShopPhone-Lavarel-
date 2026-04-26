<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <i class="fa-solid fa-bars-staggered text-gold"></i>
        </button>
        
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.home') ? 'text-gold' : '' }}" href="{{ route('frontend.home') }}">Trang chủ</a>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.sanpham*') ? 'text-gold' : '' }}" href="{{ route('frontend.sanpham') }}">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('frontend.thuonghieu*') ? 'text-gold' : '' }}" href="{{ route('frontend.thuonghieu') }}">Thương hiệu</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('frontend.baiviet*') || request()->routeIs('frontend.tuyendung') || request()->routeIs('frontend.lienhe') ? 'text-gold' : '' }}" href="#" id="navbarExplore" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Khám phá
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark border-gold p-2" aria-labelledby="navbarExplore">
                        <li><a class="dropdown-item small {{ request()->routeIs('frontend.baiviet*') ? 'text-gold' : '' }}" href="{{ route('frontend.baiviet') }}"><i class="fa-solid fa-newspaper me-2"></i> Bài viết</a></li>
                        <li><a class="dropdown-item small {{ request()->routeIs('frontend.tuyendung') ? 'text-gold' : '' }}" href="{{ route('frontend.tuyendung') }}"><i class="fa-solid fa-user-plus me-2"></i> Tuyển dụng</a></li>
                        <li><hr class="dropdown-divider bg-secondary opacity-25"></li>
                        <li><a class="dropdown-item small {{ request()->routeIs('frontend.lienhe') ? 'text-gold' : '' }}" href="{{ route('frontend.lienhe') }}"><i class="fa-solid fa-envelope me-2"></i> Liên hệ</a></li>
                    </ul>
                </li>
            </ul>   
        </div>

        <a class="navbar-brand m-auto" href="{{ route('frontend.home') }}"></a>

        <div class="nav-icons d-flex align-items-center">
            <!-- Search Wrapper -->
            <div class="search-wrapper position-relative me-3 d-none d-md-block">
                <form action="{{ route('frontend.timkiem') }}" method="GET" class="d-flex align-items-center search-form">
                    <input type="text" name="tu-khoa" id="searchInput" class="form-control form-control-sm search-input" placeholder="Tìm sản phẩm..." autocomplete="off">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div id="searchSuggestions" class="search-suggestions shadow-lg d-none"></div>
            </div>
            @guest
                <a href="{{ route('login') }}"><i class="fa-solid fa-user-large"></i></a>
            @else
                <div class="dropdown d-none d-md-inline">
                    <a href="#" class="text-gold fw-bold small text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end border-gold p-2">
                        @if(Auth::user()->role == 'admin')
                            <li><a class="dropdown-item text-gold small" href="{{ route('admin.home') }}"><i class="fa-solid fa-gauge me-2"></i> Trình quản lý</a></li>
                            <li><hr class="dropdown-divider bg-secondary"></li>
                        @endif
                        <li><a class="dropdown-item small" href="{{ route('user.hosocanhan') }}"><i class="fa-solid fa-user-pen me-2"></i> Hồ sơ cá nhân</a></li>
                        <li><a class="dropdown-item small" href="{{ route('user.donhang') ?? '#' }}"><i class="fa-solid fa-clock-rotate-left me-2"></i> Lịch sử mua hàng</a></li>
                        <li><a class="dropdown-item small" href="{{ route('user.doimatkhau') }}"><i class="fa-solid fa-key me-2"></i> Đổi mật khẩu</a></li>
                        <li>
                            <a class="dropdown-item small text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @endguest
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                <i class="fa-solid fa-shopping-bag"></i>
                <span class="cart-badge" id="cartCountBadge">0</span>
            </a>
        </div>
    </div>
</nav>
