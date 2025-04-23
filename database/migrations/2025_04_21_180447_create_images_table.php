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
        // Lưu hình ảnh cho sản phẩm hoặc người dùng.
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            // Đường dẫn đến hình ảnh
            $table->string('url');
            // Cột đa hình: imageable_id và imageable_type liên kết với products hoặc users
            $table->morphs('imageable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
