<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\LoaiSanPhamController;
use App\Http\Controllers\admin\HangSanXuatController;
use App\Http\Controllers\admin\TinhTrangController;
use App\Http\Controllers\admin\SanPhamController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\AdminController;




Auth::routes();
// Đăng nhập bằng Google
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('login.google');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('login.google.callback');

// Khu vực dành cho khách hàng chưa đăng nhập
Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'getHome'])->name('home');
    Route::get('/home', [HomeController::class, 'getHome'])->name('home');
    
    //trang san phẩm
    Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('sanpham');
    Route::get('/san-pham/{tenloai_slug}', [HomeController::class, 'getSanPham'])->name('sanpham.theoloai');
    Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('sanpham.chitiet');    

    // Trang thương hiệu
    Route::get('/thuong-hieu', [HomeController::class, 'getThuongHieu'])->name('thuonghieu');
    Route::get('/thuong-hieu/{tenhang_slug}', [HomeController::class, 'getThuongHieu'])->name('thuonghieu.theohang');

    // Trang bài viết
    Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
    Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.theochude');
    Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');
    
    // Trang tìm kiếm
    // Trang tìm kiếm
    Route::get('/tim-kiem', [HomeController::class, 'getTimKiem'])->name('timkiem');
    Route::get('/api/tim-kiem/goi-y', [HomeController::class, 'getTimKiemGoiY'])->name('timkiem.goiy');
    
    // Tuyển dụng
    Route::get('/tuyen-dung', [HomeController::class, 'getTuyenDung'])->name('tuyendung');

    // Liên hệ
    Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');


});
// Khu vực dành cho khách hàng đã dăng nhập

Route::prefix('khach-hang')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
    Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');

    // Chức năng đặt hàng
    Route::get('/dat-hang', [KhachHangController::class, 'getDatHang'])->name('dathang');
    Route::post('/dat-hang', [KhachHangController::class, 'postDathang'])->name('dathang');
    Route::get('/dat-hang-thanh-cong', [KhachHangController::class, 'getDatHangThanhCong'])->name('DatHangThanhCong');

    //Xen và cập nhật trang thái đơn hàng
    Route::get('/don-hang', [KhachHangController::class, 'getDonHang'])->name('donhang');
    Route::get('/don-hang/huy/{id}', [KhachHangController::class, 'getHuyDonHang'])->name('donhang.huy');
    Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang_ChiTiet'])->name('donhang.ChiTiet');
    Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang_ChiTiet'])->name('donhang.CapNhat');
    

    //Cập nhật thông tin tài khoản
    Route::get('/ho-so-ca-nhan', [KhachHangController::class, 'getHoSoCaNhan'])->name('hosocanhan');
    Route::post('/ho-so-ca-nhan', [KhachHangController::class, 'postHoSoCaNhan'])->name('hosocanhan');

    // Đổi mật khẩu
    Route::get('/doi-mat-khau', [KhachHangController::class, 'getDoiMatKhau'])->name('doimatkhau');
    Route::post('/doi-mat-khau', [KhachHangController::class, 'postDoiMatKhau'])->name('doimatkhau');
    
    // Đánh giá sản phẩm    
    Route::get('/danh-gia/{tensanpham_slug}', [KhachHangController::class, 'getDanhGiaSanPham'])->name('danhgia');
    Route::post('/danh-gia/{tensanpham_slug}', [KhachHangController::class, 'postDanhGiaSanPham'])->name('danhgia');
    Route::post('/danh-gia/tim/{id}', [KhachHangController::class, 'postTimDanhGia'])->name('danhgia.tim');
});


// Khu vực dành cho trang quản trị (Chỉ Admin mới được vào)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
//Trang chủ
    Route::get('/', [AdminController::class, 'getHome'])->name('home');
    Route::get('/home', [AdminController::class, 'getHome'])->name('home');

    // Cập nhật thông tin tài khoản (Hồ sơ cá nhân Admin)
    Route::get('/ho-so-ca-nhan', [AdminController::class, 'getHoSoCaNhan'])->name('hosocanhan');
    Route::post('/ho-so-ca-nhan', [AdminController::class, 'postHoSoCaNhan'])->name('hosocanhan');

    // Quản lý Loại sản phẩm
    Route::get('/loaisanpham', [LoaiSanPhamController::class, 'index'])->name('loaisanpham');
    Route::get('/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('loaisanpham.them');
    Route::post('/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('loaisanpham.them');
    Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('loaisanpham.sua');
    Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('loaisanpham.sua');
    Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('loaisanpham.xoa');

    // Quản lý Hãng sản xuất
    Route::get('/hangsanxuat', [HangSanXuatController::class, 'index'])->name('hangsanxuat');
    Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'create'])->name('hangsanxuat.them');
    Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'store'])->name('hangsanxuat.them');
    Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'edit'])->name('hangsanxuat.sua');
    Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'update'])->name('hangsanxuat.sua');
    Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'destroy'])->name('hangsanxuat.xoa');

    // Quản lý Tình trạng
    Route::get('/tinhtrang', [TinhTrangController::class, 'index'])->name('tinhtrang');
    Route::get('/tinhtrang/them', [TinhTrangController::class, 'create'])->name('tinhtrang.them');
    Route::post('/tinhtrang/them', [TinhTrangController::class, 'store'])->name('tinhtrang.them');
    Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'edit'])->name('tinhtrang.sua');
    Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'update'])->name('tinhtrang.sua');
    Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'destroy'])->name('tinhtrang.xoa');

    // Quản lý Sản phẩm
    Route::get('/sanpham', [App\Http\Controllers\admin\SanPhamController::class, 'index'])->name('sanpham');
    Route::get('/sanpham/them', [App\Http\Controllers\admin\SanPhamController::class, 'create'])->name('sanpham.them');
    Route::post('/sanpham/them', [App\Http\Controllers\admin\SanPhamController::class, 'store'])->name('sanpham.them');
    Route::get('/sanpham/sua/{id}', [App\Http\Controllers\admin\SanPhamController::class, 'edit'])->name('sanpham.sua');
    Route::post('/sanpham/sua/{id}', [App\Http\Controllers\admin\SanPhamController::class, 'update'])->name('sanpham.sua');
    Route::get('/sanpham/xoa/{id}', [App\Http\Controllers\admin\SanPhamController::class, 'destroy'])->name('sanpham.xoa'); 
    Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('sanpham.xuat');
    Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('sanpham.nhap');

    // Quản lý Đơn hàng
    Route::get('/donhang', [App\Http\Controllers\admin\DonHangController::class, 'index'])->name('donhang');
    Route::get('/donhang/sua/{id}', [App\Http\Controllers\admin\DonHangController::class, 'edit'])->name('donhang.sua');
    Route::post('/donhang/sua/{id}', [App\Http\Controllers\admin\DonHangController::class, 'update'])->name('donhang.sua');
    Route::get('/donhang/xoa/{id}', [App\Http\Controllers\admin\DonHangController::class, 'destroy'])->name('donhang.xoa');
    Route::get('/donhang/chitiet/{id}', [App\Http\Controllers\admin\DonHangChiTietController::class, 'show'])->name('donhang.chitiet');


    // Quản lý Người dùng
    Route::get('/nguoidung', [App\Http\Controllers\admin\UserController::class, 'index'])->name('nguoidung');
    Route::get('/nguoidung/them', [App\Http\Controllers\admin\UserController::class, 'create'])->name('nguoidung.them');    
    Route::post('/nguoidung/them', [App\Http\Controllers\admin\UserController::class, 'store'])->name('nguoidung.them');
    Route::get('/nguoidung/sua/{id}', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('nguoidung.sua');
    Route::post('/nguoidung/sua/{id}', [App\Http\Controllers\admin\UserController::class, 'update'])->name('nguoidung.sua');
    Route::get('/nguoidung/xoa/{id}', [App\Http\Controllers\admin\UserController::class, 'destroy'])->name('nguoidung.xoa');

    // Quản lý Đánh giá sản phẩm 
    Route::get('/danhgia', [App\Http\Controllers\admin\DanhGiaSPController::class, 'index'])->name('danhgia');
    Route::get('/danhgia/them', [App\Http\Controllers\admin\DanhGiaSPController::class, 'create'])->name('danhgia.them');
    Route::post('/danhgia/them', [App\Http\Controllers\admin\DanhGiaSPController::class, 'store'])->name('danhgia.them');
    Route::get('/danhgia/sua/{id}', [App\Http\Controllers\admin\DanhGiaSPController::class, 'edit'])->name('danhgia.sua');
    Route::post('/danhgia/sua/{id}', [App\Http\Controllers\admin\DanhGiaSPController::class, 'update'])->name('danhgia.sua');
    Route::get('/danhgia/xoa/{id}', [App\Http\Controllers\admin\DanhGiaSPController::class, 'destroy'])->name('danhgia.xoa');
    // Thêm một đường dẫn để Admin bấm nút Ẩn/Hiện đánh giá
    Route::get('/danhgia/kichhoat/{id}', [App\Http\Controllers\admin\DanhGiaSPController::class, 'kichhoat'])->name('danhgia.kichhoat');
    Route::get('/danhgia/duyet/{id}', [App\Http\Controllers\admin\DanhGiaSPController::class, 'duyet'])->name('danhgia.duyet');

    // Quản lý Chủ đề bài viết
    Route::get('/chude', [App\Http\Controllers\admin\ChuDeController::class, 'index'])->name('chude');
    Route::get('/chude/them', [App\Http\Controllers\admin\ChuDeController::class, 'create'])->name('chude.them');
    Route::post('/chude/them', [App\Http\Controllers\admin\ChuDeController::class, 'store'])->name('chude.them');
    Route::get('/chude/sua/{id}', [App\Http\Controllers\admin\ChuDeController::class, 'edit'])->name('chude.sua');
    Route::post('/chude/sua/{id}', [App\Http\Controllers\admin\ChuDeController::class, 'update'])->name('chude.sua');
    Route::get('/chude/xoa/{id}', [App\Http\Controllers\admin\ChuDeController::class, 'destroy'])->name('chude.xoa');

    // Quản lý Bài viết
    Route::get('/baiviet', [App\Http\Controllers\admin\BaiVietController::class, 'index'])->name('baiviet');
    Route::get('/baiviet/them', [App\Http\Controllers\admin\BaiVietController::class, 'create'])->name('baiviet.them');
    Route::post('/baiviet/them', [App\Http\Controllers\admin\BaiVietController::class, 'store'])->name('baiviet.them');
    Route::get('/baiviet/sua/{id}', [App\Http\Controllers\admin\BaiVietController::class, 'edit'])->name('baiviet.sua');
    Route::post('/baiviet/sua/{id}', [App\Http\Controllers\admin\BaiVietController::class, 'update'])->name('baiviet.sua');
    Route::get('/baiviet/xoa/{id}', [App\Http\Controllers\admin\BaiVietController::class, 'destroy'])->name('baiviet.xoa');
    Route::get('/baiviet/kiemduyet/{id}', [App\Http\Controllers\admin\BaiVietController::class, 'kiemduyet'])->name('baiviet.kiemduyet');
    Route::get('/baiviet/kichhoat/{id}', [App\Http\Controllers\admin\BaiVietController::class, 'kichhoat'])->name('baiviet.kichhoat');
    // Thông báo đặt hàng
    // Route::get('/dathangdemo', [HomeController::class, 'getDatHangDemo'])->name('frontend.dathangdemo');

});