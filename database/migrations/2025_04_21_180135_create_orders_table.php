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
            // Người đặt hàng
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Trạng thái đơn hàng: pending, completed, ...
            $table->string('status')->default('pending');
            // Tổng tiền đơn hàng
            $table->decimal('total_price', 12, 2);
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
