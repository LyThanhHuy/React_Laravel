<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Phân loại sản phẩm theo danh mục.
class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['name', 'slug'];

    // One-to-Many: Category has many Products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
