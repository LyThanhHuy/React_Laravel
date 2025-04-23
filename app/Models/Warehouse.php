<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Quản lý kho hàng lưu trữ sản phẩm.
class Warehouse extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['name'];

    public function products() {
        return $this->hasMany(Product::class, 'warehouse_id', 'id');
    }
}
