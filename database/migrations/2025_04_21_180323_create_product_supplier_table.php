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
        // Kết nối Products và Suppliers trong quan hệ Many-to-Many.
        Schema::create('product_supplier', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với bảng products, xóa bản ghi nếu sản phẩm bị xóa
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // Khóa ngoại liên kết với bảng suppliers, xóa bản ghi nếu nhà cung cấp bị xóa
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_supplier');
    }
};
