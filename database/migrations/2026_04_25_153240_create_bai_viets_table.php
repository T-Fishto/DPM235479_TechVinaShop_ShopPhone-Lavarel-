<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('baiviet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chude_id')->constrained('chude');
            $table->foreignId('user_id')->constrained('users');
            $table->string('tieude');
            $table->string('tieude_slug');
            $table->text('tomtat')->nullable();
            $table->longText('noidung');
            $table->string('hinhanh')->nullable();
            $table->integer('luotxem')->default(0);
            $table->tinyInteger('kichhoat')->default(1); // 1: Hiện, 0: Ẩn
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baiviet');
    }
};
