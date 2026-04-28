@extends('layouts.frontend')
@section('title', 'Chi Tiết Đơn Hàng #' . $donhang->id)

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="display-6 playfair text-gold text-uppercase tracking-widest">Chi Tiết Đơn Hàng</h2>
            <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="bg-dark p-4 border border-secondary border-opacity-25 rounded-0 h-100">
                <h5 class="text-gold tracking-widest text-uppercase mb-4 small">Thông tin giao hàng</h5>
                
                <p class="text-white mb-2"><span class="text-white opacity-75">Mã đơn:</span> #{{ $donhang->id }}</p>
                <p class="text-white mb-2"><span class="text-white opacity-75">Ngày đặt:</span> {{ $donhang->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-white mb-2"><span class="text-white opacity-75">Trạng thái:</span> 
                    <span class="badge 
                        {{ $donhang->tinhtrang_id == 1 ? 'bg-warning text-dark' : '' }}
                        {{ $donhang->tinhtrang_id == 2 ? 'bg-info text-dark' : '' }}
                        {{ $donhang->tinhtrang_id == 3 ? 'bg-success' : '' }}
                        {{ $donhang->tinhtrang_id == 4 ? 'bg-danger' : '' }}
                    ">
                        {{ $donhang->TinhTrang->tinhtrang ?? 'Đang xử lý' }}
                    </span>
                </p>
                <hr class="border-secondary border-opacity-50 my-3">
                <p class="text-white mb-2"><span class="text-white opacity-75">Người nhận:</span> {{ Auth::user()->name }}</p>
                <p class="text-white mb-2"><span class="text-white opacity-75">Điện thoại:</span> {{ $donhang->dienthoaigiaohang }}</p>
                <p class="text-white mb-2"><span class="text-white opacity-75">Địa chỉ:</span> {{ $donhang->diachigiaohang }}</p>
                <p class="text-white mb-0"><span class="text-white opacity-75">Thanh toán:</span> 
                    @if($donhang->phuongthucthanhtoan == 'Bank')
                        <span class="text-gold"><i class="fa-solid fa-building-columns me-1"></i>Chuyển khoản ngân hàng</span>
                    @else
                        <span class="text-white"><i class="fa-solid fa-truck-ramp-box me-1"></i>Thanh toán khi nhận hàng (COD)</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="bg-dark p-4 border border-secondary border-opacity-25 rounded-0 h-100">
                <h5 class="text-gold tracking-widest text-uppercase mb-4 small">Sản phẩm đã đặt</h5>
                
                <div class="table-responsive">
                    <table class="table table-dark align-middle mb-0 border-secondary">
                        <thead class="text-white opacity-75 small tracking-widest text-uppercase">
                            <tr>
                                <th scope="col" class="bg-transparent border-secondary border-opacity-25">Sản phẩm</th>
                                <th scope="col" class="bg-transparent border-secondary border-opacity-25 text-center">Đơn giá</th>
                                <th scope="col" class="bg-transparent border-secondary border-opacity-25 text-center">Số lượng</th>
                                <th scope="col" class="bg-transparent border-secondary border-opacity-25 text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $tongTien = 0; @endphp
                            @foreach($donhang_chitiet as $chitiet)
                            @php 
                                $thanhTien = $chitiet->soluongban * $chitiet->dongiaban;
                                $tongTien += $thanhTien;
                            @endphp
                            <tr>
                                <td class="bg-transparent border-secondary border-opacity-25">
                                    <div class="d-flex align-items-center">
                                        @if($chitiet->SanPham && $chitiet->SanPham->hinhanh)
                                            <img src="{{ asset('uploads/sanpham/' . $chitiet->SanPham->hinhanh) }}" class="img-thumbnail bg-transparent border-secondary border-opacity-50 me-3 object-fit-cover" style="width: 50px; height: 50px;" alt="{{ $chitiet->SanPham->tensanpham }}">
                                        @else
                                            <div class="bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center me-3 border border-secondary border-opacity-50" style="width: 50px; height: 50px;">
                                                <i class="fa-solid fa-clock text-secondary"></i>
                                            </div>
                                        @endif
                                        <h6 class="mb-0 text-white small">{{ $chitiet->SanPham->tensanpham ?? 'Sản phẩm không còn tồn tại' }}</h6>
                                    </div>
                                </td>
                                <td class="bg-transparent border-secondary border-opacity-25 text-center text-white small">{{ number_format($chitiet->dongiaban, 0, ',', '.') }}đ</td>
                                <td class="bg-transparent border-secondary border-opacity-25 text-center text-white fw-bold">{{ $chitiet->soluongban }}</td>
                                <td class="bg-transparent border-secondary border-opacity-25 text-end text-gold small fw-bold">{{ number_format($thanhTien, 0, ',', '.') }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="bg-transparent border-secondary border-opacity-25 text-end text-white playfair small">Tạm tính:</td>
                                <td class="bg-transparent border-secondary border-opacity-25 text-end text-white small fw-bold">{{ number_format($tongTien, 0, ',', '.') }}đ</td>
                            </tr>
                            @if($donhang->ma_giam_gia)
                            <tr>
                                <td colspan="3" class="bg-transparent border-secondary border-opacity-25 text-end text-white playfair small">Giảm giá ({{ $donhang->ma_giam_gia }}):</td>
                                <td class="bg-transparent border-secondary border-opacity-25 text-end text-success small fw-bold">-{{ number_format($donhang->so_tien_giam, 0, ',', '.') }}đ</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="bg-transparent border-secondary border-opacity-25 text-end text-white playfair">Tổng cộng:</td>
                                <td class="bg-transparent border-secondary border-opacity-25 text-end text-gold fs-5 fw-bold playfair">{{ number_format($tongTien - ($donhang->so_tien_giam ?? 0), 0, ',', '.') }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <a href="{{ route('user.donhang') }}" class="btn btn-outline-secondary px-4 py-2 text-uppercase tracking-widest small">Quay lại danh sách</a>
    </div>
</div>
@endsection
