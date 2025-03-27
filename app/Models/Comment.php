<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'content',
        'parent_id',
        'is_published',
        'likes'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'likes' => 'integer'
    ];

    /**
     * Lấy đối tượng được bình luận
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Lấy người dùng đã bình luận
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy bình luận cha
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Lấy các bình luận con
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Kiểm tra xem bình luận có phải là bình luận gốc không
     */
    public function isRoot(): bool
    {
        return $this->parent_id === null;
    }

    /**
     * Kiểm tra xem bình luận có phản hồi không
     */
    public function hasReplies(): bool
    {
        return $this->replies()->count() > 0;
    }

    /**
     * Tăng lượt thích
     */
    public function incrementLikes(): self
    {
        $this->increment('likes');
        return $this;
    }

    /**
     * Đánh dấu bình luận là nổi bật
     */
    public function highlight(): self
    {
        $this->is_highlighted = true;
        $this->save();
        return $this;
    }

    /**
     * Scope lấy comment đã xuất bản
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope lấy comment gốc (không phải reply)
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope lấy comment phổ biến
     */
    public function scopePopular($query)
    {
        return $query->orderBy('likes', 'desc');
    }

    /**
     * Scope lấy bình luận đã phê duyệt
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
} 