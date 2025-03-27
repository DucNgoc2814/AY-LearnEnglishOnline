<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'review',
        'is_anonymous',
        'is_verified',
        'is_featured',
        'status',
        'is_published'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_anonymous' => 'boolean',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_published' => 'boolean'
    ];

    /**
     * Lấy người dùng đánh giá
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy khóa học được đánh giá
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Kiểm tra xem đánh giá có được hiển thị không
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Kiểm tra xem đánh giá có được đánh dấu là nổi bật không
     */
    public function isFeatured(): bool
    {
        return $this->is_featured;
    }

    /**
     * Cập nhật trạng thái đánh giá
     */
    public function updateStatus(string $status): self
    {
        $this->status = $status;
        $this->save();
        
        return $this;
    }

    /**
     * Đánh dấu đánh giá là nổi bật
     */
    public function markAsFeatured(): self
    {
        $this->is_featured = true;
        $this->save();
        
        return $this;
    }

    /**
     * Bỏ đánh dấu đánh giá là nổi bật
     */
    public function unmarkAsFeatured(): self
    {
        $this->is_featured = false;
        $this->save();
        
        return $this;
    }

    /**
     * Xác thực đánh giá
     */
    public function verify(): self
    {
        $this->is_verified = true;
        $this->save();
        
        return $this;
    }

    /**
     * Scope lấy các đánh giá đã được phê duyệt
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope lấy các đánh giá đang chờ phê duyệt
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope lấy các đánh giá được đánh dấu là nổi bật
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope lấy các đánh giá đã được xác thực
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope lấy các đánh giá theo số sao
     */
    public function scopeWithRating($query, int $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope lấy các đánh giá cao (4-5 sao)
     */
    public function scopeHighRating($query)
    {
        return $query->where('rating', '>=', 4);
    }

    /**
     * Scope lấy các đánh giá trung bình (3 sao)
     */
    public function scopeMediumRating($query)
    {
        return $query->where('rating', 3);
    }

    /**
     * Scope lấy các đánh giá thấp (1-2 sao)
     */
    public function scopeLowRating($query)
    {
        return $query->where('rating', '<=', 2);
    }
} 