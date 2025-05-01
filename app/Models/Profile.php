<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Lưu thông tin bổ sung của người dùng (số điện thoại, địa chỉ).
class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['user_id', 'phone', 'address'];

    // Hồ sơ thuộc về một người dùng
    // One-to-One: Profile belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
