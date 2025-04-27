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
        // Lưu thông tin người dùng (khách hàng, admin).
        Schema::create('users', function (Blueprint $table) {
            // Khóa chính, định danh duy nhất cho người dùng
            $table->id();
            // Tên đầy đủ của người dùng
            $table->string('name');
            // Email duy nhất dùng để đăng nhập
            $table->string('email')->unique();
            // Thời gian xác minh email, null nếu chưa xác minh
            $table->timestamp('email_verified_at')->nullable();
            // Mật khẩu mã hóa của người dùng
            $table->string('password');
            // Token để ghi nhớ đăng nhập (dùng cho tính năng "Remember Me")
            $table->rememberToken();
            // Số điện thoại người dùng
            $table->string('phone')->nullable();
            // Đường dẫn ảnh đại diện
            $table->string('avatar')->nullable();
            // Giới tính người dùng
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            // Ngày sinh (Date of Birth)
            $table->date('dob')->nullable();
            // Vai trò người dùng: customer, admin, seller...
            $table->string('role')->default('customer');
            // Thời gian tạo và cập nhật bản ghi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
