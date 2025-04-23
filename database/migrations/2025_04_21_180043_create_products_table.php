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
        // Lưu thông tin sản phẩm để bán.
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Tên của sản phẩm
            $table->string('name');
            // Giá của sản phẩm
            $table->bigInteger('price');
            // foreignId('category_id') Tạo một cột category_id kiểu BIGINT UNSIGNED, dùng làm khóa ngoại
            // constrained() Laravel tự động hiểu category_id sẽ tham chiếu đến cột id của bảng categories (theo quy tắc đặt tên)
            // onDelete('cascade') Khi category bị xóa, các bản ghi chứa category_id liên quan cũng sẽ bị xóa theo (xóa dây chuyền)
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // Thời gian tạo và cập nhật bản ghi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
