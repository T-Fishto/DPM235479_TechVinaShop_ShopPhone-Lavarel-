@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Thêm bài viết</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Nội dung bài viết</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.baiviet.them') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tieude') is-invalid @enderror" name="tieude" value="{{ old('tieude') }}" required>
                                    @error('tieude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tóm tắt ngắn</label>
                                    <textarea class="form-control" name="tomtat" rows="3">{{ old('tomtat') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nội dung chi tiết <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="noidung" rows="15" required>{{ old('noidung') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Chủ đề <span class="text-danger">*</span></label>
                                    <select class="form-select @error('chude_id') is-invalid @enderror" name="chude_id" required>
                                        <option value="">-- Chọn chủ đề --</option>
                                        @foreach($chude as $cd)
                                            <option value="{{ $cd->id }}" {{ old('chude_id') == $cd->id ? 'selected' : '' }}>{{ $cd->tenchude }}</option>
                                        @endforeach
                                    </select>
                                    @error('chude_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh đại diện</label>
                                    <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" name="hinhanh">
                                    <div class="form-text">Các định dạng: jpg, jpeg, png, gif. Tối đa 2MB.</div>
                                    @error('hinhanh')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-5 pt-3 border-top">
                                    <button type="submit" class="btn btn-primary w-100 py-2"><i class="align-middle me-1" data-feather="save"></i> Đăng bài viết</button>
                                    <a href="{{ route('admin.baiviet') }}" class="btn btn-secondary w-100 mt-2">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
