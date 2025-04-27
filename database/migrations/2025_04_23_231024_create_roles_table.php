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
        Schema::create('roles', function (Blueprint $table) {
            // Khóa chính
            $table->id();
            // Tên vai trò (admin, seller, buyer, ...)
            $table->string('name'); 
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            // Khóa chính
            $table->id();
            // Liên kết đến user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Liên kết đến role
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
