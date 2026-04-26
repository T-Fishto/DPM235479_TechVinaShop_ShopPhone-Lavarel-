@extends('layouts.admin')

@section('title', 'Sửa tình trạng')

@section('content')
<div class="container-fluid p-0">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Chỉnh sửa tình trạng</h5>
    </div>
    <div class="card-body">

        {{-- Hiển thị lỗi validation --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Có lỗi xảy ra!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.tinhtrang.sua', $tinhtrang->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên tình trạng <span class="text-danger">*</span></label>
                <input type="text" 
                       name="tinhtrang" 
                       class="form-control @error('tinhtrang') is-invalid @enderror"
                       value="{{ old('tinhtrang', $tinhtrang->tinhtrang) }}">
                @error('tinhtrang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.tinhtrang') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
</div>
@endsection