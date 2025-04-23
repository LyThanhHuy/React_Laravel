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

    // One-to-One: User has one Profile
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    // One-to-Many: User has many Orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    // Has-Many-Through: User has many Products through Orders
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            Order::class,
            'user_id', // Khóa ngoại trên bảng Orders
            'id',      // Khóa chính trên bảng Products
            'id',      // Khóa chính trên bảng Users
            'product_id' // Khóa ngoại trên bảng Orders
        );
    }

    // One-to-One Polymorphic: User has one Image
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
