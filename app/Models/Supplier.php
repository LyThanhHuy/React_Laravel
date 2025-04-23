<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Quản lý nhà cung cấp sản phẩm.
class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['name'];

    // Many-to-Many: Supplier has many Products
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_supplier', // Bảng trung gian
            'supplier_id',     // Khóa ngoại của Supplier trong bảng trung gian
            'product_id'       // Khóa ngoại của Product trong bảng trung gian
        );
    }

    // Has-One-Through: Supplier has one Warehouse through Product
    public function warehouse()
    {
        return $this->hasOneThrough(
            Warehouse::class,
            Product::class,
            'id',          // Khóa chính trên Product
            'id',          // Khóa chính trên Warehouse
            'id',          // Khóa chính trên Supplier
            'warehouse_id'  // Khóa ngoại trên Product
        );
    }
}
