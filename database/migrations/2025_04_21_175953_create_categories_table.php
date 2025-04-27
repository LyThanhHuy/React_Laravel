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
        // Phân loại sản phẩm theo danh mục.
        Schema::create('categories', function (Blueprint $table) {
            // Khóa chính, định danh duy nhất cho danh mục
            $table->id();
            // Tên của danh mục
            $table->string('name');
            // URL-friendly version của tên danh mục
            $table->string('slug')->unique();
            // Thời gian tạo và cập nhật bản ghi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
