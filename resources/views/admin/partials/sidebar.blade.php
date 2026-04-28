<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.home') }}">
            <span class="align-middle">Techvina Shop</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Quản lý hệ thống</li>

            {{-- 1. Dashboard: Sáng lên khi ở trang chủ --}}
            <li class="sidebar-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.home') }}">
                    <i class="align-middle" data-feather="sliders"></i> 
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            {{-- 2. Loại sản phẩm: Sáng lên khi ở danh sách hoặc các trang thêm/sua --}}
            <li class="sidebar-item {{ request()->routeIs('admin.loaisanpham*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.loaisanpham') }}">
                    <i class="align-middle" data-feather="grid"></i> 
                    <span class="align-middle">Loại sản phẩm</span>
                </a>
            </li>

            {{-- 3. Hãng sản xuất: Sáng lên khi làm việc với hãng --}}
             <li class="sidebar-item {{ request()->routeIs('admin.hangsanxuat*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.hangsanxuat') }}">
                    <i class="align-middle" data-feather="package"></i> 
                    <span class="align-middle">Hãng sản xuất</span>
                </a>
            </li>

           
            <li class="sidebar-item {{ request()->routeIs('admin.sanpham*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.sanpham') }}">
                    <i class="align-middle" data-feather="box"></i> 
                    <span class="align-middle">Sản phẩm</span>
                </a>
            </li> 
            

            <li class="sidebar-header">Giao dịch & Người dùng</li>

            <li class="sidebar-item {{ request()->routeIs('admin.tinhtrang*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.tinhtrang') }}">
                    <i class="align-middle" data-feather="check-square"></i> 
                    <span class="align-middle">Tình trạng</span>
                </a>
            </li>
 
            <li class="sidebar-item {{ request()->routeIs('admin.donhang*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.donhang') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> 
                    <span class="align-middle">Đơn hàng</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.voucher*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.voucher') }}">
                    <i class="align-middle" data-feather="tag"></i> 
                    <span class="align-middle">Mã giảm giá</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.nguoidung*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.nguoidung') }}">
                    <i class="align-middle" data-feather="users"></i> 
                    <span class="align-middle">Tài khoản</span>
                </a>
            </li>

            <li class="sidebar-header">Nội dung & Phản hồi</li>

            <li class="sidebar-item {{ request()->routeIs('admin.danhgia*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.danhgia') }}">
                    <i class="align-middle" data-feather="message-square"></i> 
                    <span class="align-middle">Đánh giá SP</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.chude*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.chude') }}">
                    <i class="align-middle" data-feather="list"></i> 
                    <span class="align-middle">Chủ đề bài viết</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.baiviet*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.baiviet') }}">
                    <i class="align-middle" data-feather="file-text"></i> 
                    <span class="align-middle">Bài viết (Blog)</span>
                </a>
            </li>
        </ul> 

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Shop Bán Hàng</strong>
                <div class="mb-3 text-sm">Hệ thống quản lý bán hàng biên soạn bởi Nguyễn Văn Thắng</div>
            </div>
        </div>
    </div>
</nav>