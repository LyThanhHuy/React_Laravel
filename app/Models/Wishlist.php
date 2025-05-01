<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    // Wishlist thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Wishlist chứa một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
