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
        // Theo dõi đơn hàng của người dùng.
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với bảng users, xóa đơn hàng nếu người dùng bị xóa
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Khóa ngoại liên kết với bảng products, xóa đơn hàng nếu sản phẩm bị xóa
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // Tổng giá trị đơn hàng
            $table->bigInteger('total');
            // Thời gian tạo và cập nhật bản ghi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
