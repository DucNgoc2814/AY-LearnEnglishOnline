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
     * Get the parent commentable model (course, lesson etc)
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that wrote the comment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get parent comment if this is a reply
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Get replies to this comment
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('is_published', true);
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
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope lấy bình luận đã phê duyệt
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
} 