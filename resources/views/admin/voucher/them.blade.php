@extends('layouts.admin')
@section('title', 'Thêm Mã Giảm Giá')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0"><i class="fa-solid fa-plus me-2 text-primary"></i>Thêm Mã Giảm Giá</h4>
        <a href="{{ route('admin.voucher') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.voucher.them') }}" method="POST">
                @csrf
                <div class="row g-4">
                    {{-- Mã giảm giá --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mã giảm giá <span class="text-danger">*</span></label>
                        <input type="text" name="ma_giam_gia" class="form-control text-uppercase @error('ma_giam_gia') is-invalid @enderror"
                               value="{{ old('ma_giam_gia') }}" placeholder="VD: SALE50, TETHOLIDAY..." required>
                        @error('ma_giam_gia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Tự động chuyển thành chữ hoa.</small>
                    </div>

                    {{-- Tên / Mô tả --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tên / Mô tả voucher <span class="text-danger">*</span></label>
                        <input type="text" name="ten_voucher" class="form-control @error('ten_voucher') is-invalid @enderror"
                               value="{{ old('ten_voucher') }}" placeholder="VD: Giảm 50% mừng khai trương" required>
                        @error('ten_voucher') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Loại giảm --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Loại giảm giá <span class="text-danger">*</span></label>
                        <select name="loai_giam" id="loaiGiam" class="form-select @error('loai_giam') is-invalid @enderror" required>
                            <option value="percent" {{ old('loai_giam') == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                            <option value="fixed"   {{ old('loai_giam') == 'fixed'   ? 'selected' : '' }}>Số tiền cố định (đ)</option>
                        </select>
                        @error('loai_giam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Giá trị giảm --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Giá trị giảm <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="gia_tri_giam" class="form-control @error('gia_tri_giam') is-invalid @enderror"
                                   value="{{ old('gia_tri_giam') }}" min="1" placeholder="50" required>
                            <span class="input-group-text" id="donViGiam">%</span>
                        </div>
                        @error('gia_tri_giam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Giảm tối đa (chỉ hiện khi chọn %) --}}
                    <div class="col-md-4" id="giamToiDaGroup">
                        <label class="form-label fw-semibold">Giảm tối đa (đ)</label>
                        <input type="number" name="giam_toi_da" class="form-control" value="{{ old('giam_toi_da', 0) }}" min="0" placeholder="0 = không giới hạn">
                        <small class="text-muted">0 = Không giới hạn mức giảm tối đa.</small>
                    </div>

                    {{-- Đơn hàng tối thiểu --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Đơn hàng tối thiểu (đ)</label>
                        <input type="number" name="don_hang_toi_thieu" class="form-control" value="{{ old('don_hang_toi_thieu', 0) }}" min="0">
                        <small class="text-muted">0 = Không yêu cầu giá trị tối thiểu.</small>
                    </div>

                    {{-- Số lần dùng tối đa --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Số lần dùng tối đa</label>
                        <input type="number" name="so_lan_su_dung_toi_da" class="form-control" value="{{ old('so_lan_su_dung_toi_da') }}" min="1" placeholder="Để trống = không giới hạn">
                    </div>

                    {{-- Ngày bắt đầu --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ngày bắt đầu</label>
                        <input type="date" name="ngay_bat_dau" class="form-control" value="{{ old('ngay_bat_dau') }}">
                    </div>

                    {{-- Ngày hết hạn --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ngày hết hạn</label>
                        <input type="date" name="ngay_het_han" class="form-control @error('ngay_het_han') is-invalid @enderror" value="{{ old('ngay_het_han') }}">
                        @error('ngay_het_han') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Kích hoạt --}}
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch fs-5">
                            <input class="form-check-input" type="checkbox" name="kichhoat" id="kichhoat" {{ old('kichhoat', '1') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="kichhoat">Kích hoạt ngay</label>
                        </div>
                    </div>

                    <div class="col-12 pt-2 border-top">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Lưu mã giảm giá
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const loaiGiam  = document.getElementById('loaiGiam');
    const donVi     = document.getElementById('donViGiam');
    const maxGroup  = document.getElementById('giamToiDaGroup');

    function capNhatUI() {
        if (loaiGiam.value === 'percent') {
            donVi.textContent  = '%';
            maxGroup.style.display = '';
        } else {
            donVi.textContent  = 'đ';
            maxGroup.style.display = 'none';
        }
    }
    loaiGiam.addEventListener('change', capNhatUI);
    capNhatUI();
</script>
@endpush
@endsection
