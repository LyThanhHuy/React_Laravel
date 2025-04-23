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
        Schema::table('products', function (Blueprint $table) {
            // foreignId('warehouse_id') Tạo một cột warehouse_id kiểu BIGINT UNSIGNED, dùng làm khóa ngoại
            // constrained() Laravel tự động hiểu category_id sẽ tham chiếu đến cột id của bảng warehouses (theo quy tắc đặt tên)
            // onDelete('cascade') Khi category bị xóa, các bản ghi chứa category_id liên quan cũng sẽ bị xóa theo (xóa dây chuyền)
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn('warehouse_id');
        });
    }
};
