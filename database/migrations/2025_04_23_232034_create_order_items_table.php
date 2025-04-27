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
        Schema::create('order_items', function (Blueprint $table) {
            // Khóa chính
            $table->id();
            // Khóa ngoại đến orders.id
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            // Khóa ngoại đến products.id
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // Số lượng sản phẩm mua
            $table->integer('quantity');
            // Giá tại thời điểm mua
            $table->decimal('price', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
