@extends('layouts.admin')
@section('title', 'Quản lý mã giảm giá')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý mã giảm giá</h1>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="alert-message">
                <i class="align-middle me-1" data-feather="check-circle"></i>
                {{ session('status') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Danh sách mã giảm giá</h5>
            <a href="{{ route('admin.voucher.them') }}" class="btn btn-primary">
                <i class="align-middle" data-feather="plus"></i> Thêm mã mới
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover my-0 align-middle">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Mã</th>
                        <th>Tên / Mô tả</th>
                        <th>Loại giảm</th>
                        <th>Giá trị</th>
                        <th>Đơn tối thiểu</th>
                        <th>Đã dùng</th>
                        <th>Hết hạn</th>
                        <th class="text-center">Trạng thái</th>
                        <th width="5%" class="text-center">Sửa</th>
                        <th width="5%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vouchers as $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-dark">{{ $v->ma_giam_gia }}</span>
                        </td>
                        <td>{{ $v->ten_voucher }}</td>
                        <td>
                            @if($v->loai_giam === 'percent')
                                <span class="text-info">Phần trăm (%)</span>
                            @else
                                <span class="text-warning">Số tiền cố định</span>
                            @endif
                        </td>
                        <td class="fw-bold text-danger">
                            @if($v->loai_giam === 'percent')
                                {{ $v->gia_tri_giam }}%
                                @if($v->giam_toi_da > 0)
                                    <br><small class="text-muted" style="font-size: 0.7rem;">(Tối đa {{ number_format($v->giam_toi_da, 0, ',', '.') }}đ)</small>
                                @endif
                            @else
                                {{ number_format($v->gia_tri_giam, 0, ',', '.') }}đ
                            @endif
                        </td>
                        <td>
                            {{ $v->don_hang_toi_thieu > 0 ? number_format($v->don_hang_toi_thieu, 0, ',', '.') . 'đ' : '0đ' }}
                        </td>
                        <td>
                            {{ $v->so_lan_da_su_dung }}{{ $v->so_lan_su_dung_toi_da ? ' / ' . $v->so_lan_su_dung_toi_da : ' / ∞' }}
                        </td>
                        <td>
                            @if($v->ngay_het_han)
                                <span class="{{ $v->ngay_het_han < now()->toDateString() ? 'text-danger fw-bold' : '' }}">
                                    {{ date('d/m/Y', strtotime($v->ngay_het_han)) }}
                                </span>
                            @else
                                <span class="text-muted">Không hạn</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.voucher.kichhoat', $v->id) }}">
                                @if($v->kichhoat)
                                    <i class="align-middle text-success" data-feather="check-circle"></i>
                                @else
                                    <i class="align-middle text-secondary" data-feather="slash"></i>
                                @endif
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.voucher.sua', $v->id) }}">
                                <i class="align-middle text-warning" data-feather="edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.voucher.xoa', $v->id) }}"
                               onclick="return confirm('Bạn có chắc muốn xóa mã này?')">
                                <i class="align-middle text-danger" data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-4 text-muted">Chưa có mã giảm giá nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

