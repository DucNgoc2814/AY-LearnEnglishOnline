<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'published_at',
        'views',
        'likes',
        'allow_comments'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
        'likes' => 'integer',
        'allow_comments' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Tăng lượt xem
     */
    public function incrementViews(): self
    {
        $this->increment('views');
        return $this;
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
     * Scope lấy bài viết đã xuất bản
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope lấy bài viết phổ biến
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Scope lấy bài viết được yêu thích
     */
    public function scopeMostLiked($query)
    {
        return $query->orderBy('likes', 'desc');
    }
} 