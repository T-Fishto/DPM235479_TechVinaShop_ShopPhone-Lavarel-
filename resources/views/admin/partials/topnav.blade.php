<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>
                </li>

            <li class="nav-item dropdown">
                @guest
                    <a class="nav-link d-none d-sm-inline-block" href="{{ route('login') }}">Đăng nhập</a>
                @else
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        @if(Auth::user()->hinhanh)
                            <img src="{{ asset('uploads/profile/' . Auth::user()->hinhanh) }}" class="avatar img-fluid rounded me-1 object-fit-cover" alt="User" /> 
                        @else
                            <div class="avatar img-fluid rounded me-1 bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i data-feather="user"></i></div>
                        @endif
                        <span class="text-dark">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('frontend.home') }}" target="_blank"><i class="align-middle me-1" data-feather="home"></i> Xem trang chủ</a>
                        <a class="dropdown-item" href="{{ route('admin.hosocanhan') }}"><i class="align-middle me-1" data-feather="user"></i> Hồ sơ</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </li>
        </ul>
    </div>
</nav>