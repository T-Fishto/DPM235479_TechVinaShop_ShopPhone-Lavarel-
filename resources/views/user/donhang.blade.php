@extends('layouts.frontend')
@section('title', 'Lịch Sử Mua Hàng')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="display-6 playfair text-gold text-uppercase tracking-widest">Lịch Sử Mua Hàng</h2>
            <div class="bg-gold mx-auto my-3" style="width: 60px; height: 2px;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="bg-dark p-4 border border-secondary border-opacity-25 rounded-0">
                @if($donhang->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-solid fa-box-open text-secondary mb-4" style="font-size: 4rem;"></i>
                        <p class="text-white lead mb-4">Bạn chưa có đơn hàng nào.</p>
                        <a href="{{ route('frontend.sanpham') }}" class="btn btn-lux px-4 py-2 text-uppercase tracking-widest small">Bắt đầu mua sắm</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle mb-0 border-secondary">
                            <thead class="text-white small tracking-widest text-uppercase border-bottom border-secondary">
                                <tr>
                                    <th scope="col" class="bg-transparent border-secondary border-opacity-25">Mã đơn</th>
                                    <th scope="col" class="bg-transparent border-secondary border-opacity-25">Ngày đặt</th>
                                    <th scope="col" class="bg-transparent border-secondary border-opacity-25">Trạng thái</th>
                                    <th scope="col" class="bg-transparent border-secondary border-opacity-25 text-end">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donhang as $dh)
                                <tr>
                                    <td class="bg-transparent border-secondary border-opacity-25 fw-bold text-white">#{{ $dh->id }}</td>
                                    <td class="bg-transparent border-secondary border-opacity-25 text-white">{{ $dh->created_at ? $dh->created_at->format('d/m/Y H:i') : '' }}</td>
                                    <td class="bg-transparent border-secondary border-opacity-25">
                                        <span class="badge 
                                            {{ $dh->tinhtrang_id == 1 ? 'bg-warning text-dark' : '' }}
                                            {{ $dh->tinhtrang_id == 2 ? 'bg-info text-dark' : '' }}
                                            {{ $dh->tinhtrang_id == 3 ? 'bg-success' : '' }}
                                            {{ $dh->tinhtrang_id == 4 ? 'bg-danger' : '' }}
                                        ">
                                            {{ $dh->TinhTrang->tinhtrang ?? 'Đang xử lý' }}
                                        </span>
                                    </td>
                                    <td class="bg-transparent border-secondary border-opacity-25 text-end">
                                        <a href="{{ route('user.donhang.ChiTiet', ['id' => $dh->id]) }}" class="btn btn-outline-light btn-sm px-3 py-1 text-uppercase tracking-widest" style="font-size: 0.7rem;">Chi tiết</a>
                                        @if($dh->tinhtrang_id == 1)
                                            <a href="{{ route('user.donhang.huy', ['id' => $dh->id]) }}" class="btn btn-outline-danger btn-sm px-3 py-1 text-uppercase tracking-widest" style="font-size: 0.7rem;" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">Hủy đơn</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
