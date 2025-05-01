<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Theo dõi đơn hàng của người dùng.
class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['user_id', 'status', 'total_price'];

    // Many-to-One: Order belongs to User
    // Đơn hàng thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Đơn hàng có nhiều sản phẩm (qua order_items)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    // Đơn hàng có thể áp dụng nhiều coupon
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'order_coupons', 'order_id', 'coupon_id');
    }
}
