<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Lưu thông tin bổ sung của người dùng (số điện thoại, địa chỉ).
class Product extends Model
{
    use HasFactory;

    // Khóa chính (mặc định là 'id', có thể không cần khai báo nếu không đổi)
    protected $primaryKey = 'id';

    // Tên bảng (mặc định là 'products', có thể khai báo rõ nếu muốn)
    protected $table = 'products';

    // Các trường được phép fill vào DB
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'price',
        'stock'
    ];

    /**
     * Quan hệ: Product thuộc về 1 User (người đăng)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
        // FK: user_id, PK: id của users
    }

    /**
     * Quan hệ: Product thuộc về 1 Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
        // FK: category_id, PK: id của categories
    }

    /**
     * Quan hệ: Product có nhiều OrderItem
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
        // FK: product_id của order_items, PK: id của products
    }

    /**
     * Quan hệ: Product có nhiều Wishlist
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id', 'id');
    }

    /**
     * Quan hệ đa hình: Product có nhiều Images
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
