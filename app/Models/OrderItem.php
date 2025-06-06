<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Mỗi dòng order_item thuộc một đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // Mỗi dòng order_item chứa một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
