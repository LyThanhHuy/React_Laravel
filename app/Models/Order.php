<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Theo dõi đơn hàng của người dùng.
class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['user_id', 'product_id', 'total'];

    // Many-to-One: Order belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Many-to-One: Order belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // One-to-Many Polymorphic: Order has many Comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
