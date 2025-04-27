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
        Schema::create('coupons', function (Blueprint $table) {
            // Khóa chính
            $table->id();
            // Mã giảm giá
            $table->string('code')->unique();
            // Giá trị giảm
            $table->decimal('discount', 10, 2);
            // Ngày hết hạn
            $table->date('expiration_date');
            $table->timestamps();
        });

        Schema::create('order_coupons', function (Blueprint $table) {
            // Khóa chính
            $table->id();
            // Khóa ngoại đến orders.id
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            // Khóa ngoại đến coupons.id
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_coupons');
        Schema::dropIfExists('coupons');
    }
};
