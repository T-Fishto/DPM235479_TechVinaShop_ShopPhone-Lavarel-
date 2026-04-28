<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donhang', function (Blueprint $table) {
            $table->string('ma_giam_gia', 50)->nullable()->after('diachigiaohang'); // Mã voucher đã dùng
            $table->unsignedBigInteger('so_tien_giam')->default(0)->after('ma_giam_gia'); // Số tiền được giảm
        });
    }

    public function down(): void
    {
        Schema::table('donhang', function (Blueprint $table) {
            $table->dropColumn(['ma_giam_gia', 'so_tien_giam']);
        });
    }
};
