<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'expiration_date'];

    // Coupon có thể được áp dụng cho nhiều đơn hàng
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_coupons', 'coupon_id', 'order_id');
    }
}
