@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Thêm chủ đề</h1>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin chủ đề</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.chude.them') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên chủ đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tenchude') is-invalid @enderror" name="tenchude" placeholder="Nhập tên chủ đề bài viết..." value="{{ old('tenchude') }}" required>
                            @error('tenchude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary"><i class="align-middle me-1" data-feather="save"></i> Thêm chủ đề</button>
                            <a href="{{ route('admin.chude') }}" class="btn btn-secondary ms-2">Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
