<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('ma_giam_gia', 50)->unique();        // Mã voucher (VD: SALE50)
            $table->string('ten_voucher');                       // Tên mô tả voucher
            $table->enum('loai_giam', ['percent', 'fixed']);    // % hoặc số tiền cố định
            $table->unsignedBigInteger('gia_tri_giam');         // Giá trị giảm (50 = 50% hoặc 50.000đ)
            $table->unsignedBigInteger('giam_toi_da')->default(0); // Giảm tối đa (chỉ áp dụng cho percent, 0 = không giới hạn)
            $table->unsignedBigInteger('don_hang_toi_thieu')->default(0); // Đơn hàng tối thiểu để dùng
            $table->unsignedInteger('so_lan_su_dung_toi_da')->nullable(); // null = không giới hạn
            $table->unsignedInteger('so_lan_da_su_dung')->default(0);
            $table->date('ngay_bat_dau')->nullable();
            $table->date('ngay_het_han')->nullable();
            $table->tinyInteger('kichhoat')->default(1);        // 1 = đang hoạt động
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
