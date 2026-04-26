@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Chi tiết đơn hàng #{{ $donhang->id }}</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Thông tin giao hàng</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Khách hàng:</strong> {{ $donhang->User->name ?? 'Khách lẻ' }}</p>
                    <p><strong>Điện thoại:</strong> {{ $donhang->dienthoaigiaohang }}</p>
                    <p><strong>Địa chỉ giao:</strong> {{ $donhang->diachigiaohang }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngày đặt hàng:</strong> {{ $donhang->created_at->format('d/m/Y H:i') }}</p>
                    <p>
                        <strong>Trạng thái:</strong> 
                        @if($donhang->tinhtrang_id == 1)
                            <span class="badge bg-secondary">{{ $donhang->TinhTrang->tentinhtrang ?? 'Đã đặt' }}</span>
                        @elseif($donhang->tinhtrang_id == 2)
                            <span class="badge bg-warning text-dark">{{ $donhang->TinhTrang->tentinhtrang ?? 'Đang xử lý' }}</span>
                        @elseif($donhang->tinhtrang_id == 4)
                            <span class="badge bg-danger">{{ $donhang->TinhTrang->tentinhtrang ?? 'Đã hủy' }}</span>
                        @else
                            <span class="badge bg-success">{{ $donhang->TinhTrang->tentinhtrang ?? 'Đã giao' }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Chi tiết sản phẩm</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-end">Đơn giá</th>
                        <th class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $tongTien = 0; @endphp
                    @foreach($chitiet as $ct)
                        @php 
                            $thanhTien = $ct->soluongban * $ct->dongiaban;
                            $tongTien += $thanhTien;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ct->SanPham->tensanpham ?? 'Sản phẩm không xác định' }}</td>
                            <td class="text-center">{{ $ct->soluongban }}</td>
                            <td class="text-end">{{ number_format($ct->dongiaban, 0, ',', '.') }}đ</td>
                            <td class="text-end">{{ number_format($thanhTien, 0, ',', '.') }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng cộng thanh toán:</strong></td>
                        <td class="text-end text-danger"><strong>{{ number_format($tongTien, 0, ',', '.') }}đ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.home') }}" class="btn btn-secondary"><i class="align-middle me-2" data-feather="arrow-left"></i> Quay lại Bảng điều khiển</a>
            <a href="{{ route('admin.donhang') }}" class="btn btn-primary"><i class="align-middle me-2" data-feather="list"></i> Quản lý đơn hàng</a>
        </div>
    </div>
</div>
@endsection
