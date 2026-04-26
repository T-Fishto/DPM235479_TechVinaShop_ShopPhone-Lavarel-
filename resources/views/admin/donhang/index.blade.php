@extends('layouts.admin')
@section('title', 'Danh sách đơn hàng')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Quản lý đơn hàng</h1>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="align-middle me-1" data-feather="check-circle"></i>
            <strong>Thành công!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="15%">Khách hàng</th>
                        <th>Thông tin giao hàng</th>
                        <th width="15%">Ngày đặt</th>
                        <th width="10%">Tình trạng</th>
                        <th width="5%" class="text-center">Sửa</th>
                        <th width="5%" class="text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donhang as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $value->User->name }}</strong></td>
                        <td>
                            <small class="d-block">SĐT: {{ $value->dienthoaigiaohang }}</small>
                            <small class="d-block text-muted">Đ/C: {{ $value->diachigiaohang }}</small>
                            
                            {{-- Bảng con hiển thị sản phẩm --}}
                            <div class="mt-2">
                                @php $tongtien = 0; @endphp
                                @foreach($value->DonHang_ChiTiet as $chitiet)
                                    <div class="small">
                                        - {{ $chitiet->SanPham->tensanpham }} (SL: {{ $chitiet->soluongban }}) 
                                        : {{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}đ
                                    </div>
                                    @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
                                @endforeach
                                <div class="fw-bold text-primary">Tổng: {{ number_format($tongtien) }}đ</div>
                            </div>
                        </td>
                        <td>{{ $value->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.donhang.sua', ['id' => $value->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="dienthoaigiaohang" value="{{ $value->dienthoaigiaohang }}">
                                <input type="hidden" name="diachigiaohang" value="{{ $value->diachigiaohang }}">
                                <select name="tinhtrang_id" class="form-select form-select-sm fw-bold rounded-pill shadow-sm
                                    @if($value->tinhtrang_id == 1) bg-secondary text-white
                                    @elseif($value->tinhtrang_id == 2) bg-warning text-dark
                                    @elseif($value->tinhtrang_id == 4) bg-danger text-white
                                    @else bg-success text-white @endif" 
                                    onchange="this.form.submit()" style="font-size: 0.85em; border:none; cursor:pointer; min-width: 120px; padding-right: 30px;">
                                    @foreach($tinhtrang as $tt)
                                        <option value="{{ $tt->id }}" {{ $value->tinhtrang_id == $tt->id ? 'selected' : '' }} class="bg-light text-dark">
                                            {{ $tt->tinhtrang ?? $tt->tentinhtrang }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.donhang.sua', ['id' => $value->id]) }}"><i class="text-warning" data-feather="edit"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.donhang.xoa', ['id' => $value->id]) }}" onclick="return confirm('Xóa đơn hàng của {{ $value->User->name }}?')">
                                <i class="text-danger" data-feather="trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection