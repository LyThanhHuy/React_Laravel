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
        // Lưu thông tin bổ sung của người dùng (số điện thoại, địa chỉ).
        Schema::create('profiles', function (Blueprint $table) {
            // 'Khóa chính, định danh duy nhất cho hồ sơ
            $table->id();
            // foreignId('user_id') Tạo một cột user_id kiểu BIGINT UNSIGNED, dùng làm khóa ngoại
            // constrained() Laravel tự động hiểu user_id sẽ tham chiếu đến cột id của bảng users (theo quy tắc đặt tên)
            // onDelete('cascade') Khi user bị xóa, các bản ghi chứa user_id liên quan cũng sẽ bị xóa theo (xóa dây chuyền)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Số điện thoại của người dùng (có thể để trống
            $table->string('phone')->nullable();
            // Địa chỉ của người dùng (có thể để trống)
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
