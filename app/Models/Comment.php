<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Lưu bình luận về sản phẩm hoặc đơn hàng.
class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Khóa chính: id
    protected $fillable = ['content', 'commentable_id', 'commentable_type'];

    // One-to-Many Polymorphic: Comment belongs to Commentable
    public function commentable()
    {
        return $this->morphTo();
    }
}
