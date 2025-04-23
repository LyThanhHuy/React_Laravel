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
        // Lưu bình luận về sản phẩm hoặc đơn hàng.
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // Nội dung của bình luận
            $table->text('content');
            // Cột đa hình: commentable_id và commentable_type liên kết với products hoặc orders
            $table->morphs('commentable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
