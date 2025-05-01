<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id'; // Khóa chính: id
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'gender',
        'dob',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Một người dùng có một hồ sơ cá nhân (profile)
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    // Một người dùng có nhiều đơn hàng
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    // Một người dùng có thể có nhiều sản phẩm đã đăng
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    // Một người dùng có nhiều sản phẩm trong danh sách yêu thích
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }

    // Một người dùng có thể có nhiều vai trò (role)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    // Một người dùng có thể có nhiều bình luận
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
