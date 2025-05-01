<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Lưu bình luận về sản phẩm hoặc đơn hàng.
class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['user_id', 'commentable_id', 'commentable_type', 'content'];

    // Bình luận thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // One-to-Many Polymorphic: Comment belongs to Commentable
    // Bình luận thuộc về một entity đa hình (product, blog, v.v.)
    public function commentable()
    {
        return $this->morphTo();
    }
}
