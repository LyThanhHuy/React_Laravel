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

    // 🔁 Các trạng thái đơn hàng (hằng số)
    const STATUS_PENDING   = 'pending';
    const STATUS_PAID      = 'paid';
    const STATUS_SHIPPED   = 'shipped';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    // 🔁 Mảng các trạng thái đơn hàng với nhãn tiếng Việt
    public static function statuses()
    {
        return [
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_PAID      => 'Paid',
            self::STATUS_SHIPPED   => 'Shipped',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

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
