@extends('layouts.admin')
@section('title', 'Cập nhật đơn hàng')
@section('content')
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Chỉnh sửa đơn hàng #{{ $donhang->id }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.donhang.sua', ['id' => $donhang->id]) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Khách hàng</label>
                    <input type="text" class="form-control" value="{{ $donhang->User->name }}" disabled />
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Điện thoại giao hàng</label>
                        <input type="text" class="form-control @error('dienthoaigiaohang') is-invalid @enderror" name="dienthoaigiaohang" value="{{ old('dienthoaigiaohang', $donhang->dienthoaigiaohang) }}" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tình trạng đơn hàng</label>
                        <select class="form-select" name="tinhtrang_id" required>
                            @foreach($tinhtrang as $value)
                                <option value="{{ $value->id }}" {{ ($donhang->tinhtrang_id == $value->id) ? 'selected' : '' }}>{{ $value->tinhtrang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ giao hàng</label>
                    <input type="text" class="form-control" name="diachigiaohang" value="{{ old('diachigiaohang', $donhang->diachigiaohang) }}" required />
                </div>

                <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i> Cập nhật</button>
                <a href="{{ route('admin.donhang') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection