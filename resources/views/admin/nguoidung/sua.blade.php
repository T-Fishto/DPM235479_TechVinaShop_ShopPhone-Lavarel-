@extends('layouts.admin')
@section('title', 'Sửa người dùng')

@section('content')
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Chỉnh sửa người dùng: {{ $nguoidung->name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.nguoidung.sua', ['id' => $nguoidung->id]) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $nguoidung->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $nguoidung->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phân quyền <span class="text-danger">*</span></label>
                    <select name="role" class="form-select" required>
                        <option value="user" {{ ($nguoidung->role == 'user') ? 'selected' : '' }}>Khách hàng (User)</option>
                        <option value="admin" {{ ($nguoidung->role == 'admin') ? 'selected' : '' }}>Quản trị viên (Admin)</option>
                    </select>
                </div>

                {{-- Hộp kiểm ẩn hiện đổi mật khẩu --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="change_password_checkbox" name="change_password_checkbox">
                    <label class="form-check-label fw-bold text-primary" for="change_password_checkbox">Đổi mật khẩu tài khoản này</label>
                </div>

                {{-- Nhóm nhập mật khẩu (Mặc định sẽ bị JS ẩn đi) --}}
                <div id="change_password_group" class="row bg-light pt-3 pb-2 rounded mb-3 border">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i> Cập nhật</button>
                <a href="{{ route('admin.nguoidung') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

{{-- ĐOẠN JAVASCRIPT XỬ LÝ ẨN/HIỆN ĐỔI MẬT KHẨU --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Mới vào trang thì ẩn khung mật khẩu đi
        $("#change_password_group").hide();
        
        // Bắt sự kiện khi click vào ô checkbox
        $("#change_password_checkbox").change(function() {
            if($(this).is(":checked")) {
                $("#change_password_group").show(); // Hiện lên
                $("#change_password_group input").attr("required", "required"); // Bắt buộc nhập
            } else {
                $("#change_password_group").hide(); // Ẩn đi
                $("#change_password_group input").removeAttr("required"); // Hủy bắt buộc nhập
            }
        });
    });
</script>
@endsection