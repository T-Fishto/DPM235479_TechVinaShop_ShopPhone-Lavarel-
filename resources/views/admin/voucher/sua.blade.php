@extends('layouts.admin')
@section('title', 'Sửa Mã Giảm Giá')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0"><i class="fa-solid fa-pen-to-square me-2 text-warning"></i>Sửa Mã Giảm Giá</h4>
        <a href="{{ route('admin.voucher') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.voucher.sua', $voucher->id) }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mã giảm giá <span class="text-danger">*</span></label>
                        <input type="text" name="ma_giam_gia" class="form-control text-uppercase @error('ma_giam_gia') is-invalid @enderror"
                               value="{{ old('ma_giam_gia', $voucher->ma_giam_gia) }}" required>
                        @error('ma_giam_gia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tên / Mô tả <span class="text-danger">*</span></label>
                        <input type="text" name="ten_voucher" class="form-control @error('ten_voucher') is-invalid @enderror"
                               value="{{ old('ten_voucher', $voucher->ten_voucher) }}" required>
                        @error('ten_voucher') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Loại giảm giá <span class="text-danger">*</span></label>
                        <select name="loai_giam" id="loaiGiam" class="form-select" required>
                            <option value="percent" {{ old('loai_giam', $voucher->loai_giam) == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                            <option value="fixed"   {{ old('loai_giam', $voucher->loai_giam) == 'fixed'   ? 'selected' : '' }}>Số tiền cố định (đ)</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Giá trị giảm <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" name="gia_tri_giam" class="form-control @error('gia_tri_giam') is-invalid @enderror"
                                   value="{{ old('gia_tri_giam', $voucher->gia_tri_giam) }}" min="1" required>
                            <span class="input-group-text" id="donViGiam">{{ $voucher->loai_giam === 'percent' ? '%' : 'đ' }}</span>
                        </div>
                        @error('gia_tri_giam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4" id="giamToiDaGroup" style="{{ $voucher->loai_giam === 'fixed' ? 'display:none' : '' }}">
                        <label class="form-label fw-semibold">Giảm tối đa (đ)</label>
                        <input type="number" name="giam_toi_da" class="form-control" value="{{ old('giam_toi_da', $voucher->giam_toi_da) }}" min="0">
                        <small class="text-muted">0 = Không giới hạn.</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Đơn hàng tối thiểu (đ)</label>
                        <input type="number" name="don_hang_toi_thieu" class="form-control" value="{{ old('don_hang_toi_thieu', $voucher->don_hang_toi_thieu) }}" min="0">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Số lần dùng tối đa</label>
                        <input type="number" name="so_lan_su_dung_toi_da" class="form-control" value="{{ old('so_lan_su_dung_toi_da', $voucher->so_lan_su_dung_toi_da) }}" min="1" placeholder="Để trống = không giới hạn">
                        <small class="text-muted">Đã dùng: <strong>{{ $voucher->so_lan_da_su_dung }}</strong> lần</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ngày bắt đầu</label>
                        <input type="date" name="ngay_bat_dau" class="form-control" value="{{ old('ngay_bat_dau', $voucher->ngay_bat_dau) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ngày hết hạn</label>
                        <input type="date" name="ngay_het_han" class="form-control @error('ngay_het_han') is-invalid @enderror" value="{{ old('ngay_het_han', $voucher->ngay_het_han) }}">
                        @error('ngay_het_han') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch fs-5">
                            <input class="form-check-input" type="checkbox" name="kichhoat" id="kichhoat" {{ $voucher->kichhoat ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="kichhoat">Kích hoạt</label>
                        </div>
                    </div>

                    <div class="col-12 pt-2 border-top">
                        <button type="submit" class="btn btn-warning px-5">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const loaiGiam = document.getElementById('loaiGiam');
    const donVi    = document.getElementById('donViGiam');
    const maxGroup = document.getElementById('giamToiDaGroup');

    function capNhatUI() {
        if (loaiGiam.value === 'percent') {
            donVi.textContent = '%';
            maxGroup.style.display = '';
        } else {
            donVi.textContent = 'đ';
            maxGroup.style.display = 'none';
        }
    }
    loaiGiam.addEventListener('change', capNhatUI);
</script>
@endpush
@endsection
