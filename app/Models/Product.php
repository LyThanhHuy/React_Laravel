<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Lưu thông tin bổ sung của người dùng (số điện thoại, địa chỉ).
class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['name', 'price', 'category_id', 'warehouse_id'];

    // Many-to-One: Product belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Many-to-One: Product belongs to Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    // Many-to-Many: Product has many Suppliers
    public function suppliers()
    {
        return $this->belongsToMany(
            Supplier::class,
            'product_supplier', // Bảng trung gian
            'product_id',      // Khóa ngoại của Product trong bảng trung gian
            'supplier_id'      // Khóa ngoại của Supplier trong bảng trung gian
        );
    }

    // One-to-One Polymorphic: Product has one Image
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // One-to-Many Polymorphic: Product has many Comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
