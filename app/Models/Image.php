<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Lưu hình ảnh cho sản phẩm hoặc người dùng.
class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['url', 'imageable_id', 'imageable_type'];

    // One-to-One Polymorphic: Image belongs to Imageable
    public function imageable()
    {
        return $this->morphTo();
    }
}
