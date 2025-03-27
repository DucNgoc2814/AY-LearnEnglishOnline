<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Progress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'progressable_type',
        'progressable_id',
        'status',
        'progress_percentage',
        'last_accessed_at',
        'completed_at',
        'meta_data'
    ];

    protected $casts = [
        'progress_percentage' => 'integer',
        'last_accessed_at' => 'datetime',
        'completed_at' => 'datetime',
        'meta_data' => 'json'
    ];

    /**
     * Lấy người dùng liên quan đến tiến độ
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy đối tượng liên quan đến tiến độ
     */
    public function progressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Kiểm tra xem bài học đã hoàn thành chưa
     */
    public function isCompleted(): bool
    {
        return $this->completed_at !== null;
    }

    /**
     * Đánh dấu bài học đã hoàn thành
     */
    public function markAsCompleted(): self
    {
        $this->completed_at = now();
        $this->progress_percentage = 100;
        $this->save();
        
        return $this;
    }

    /**
     * Cập nhật tiến độ bài học
     */
    public function updateProgress(int $percentage): self
    {
        $this->progress_percentage = $percentage;
        
        if ($percentage >= 100) {
            $this->markAsCompleted();
        } else {
            $this->completed_at = null;
            $this->save();
        }
        
        return $this;
    }

    /**
     * Format tiến độ bài học dưới dạng phần trăm
     */
    public function getFormattedProgress(): string
    {
        return $this->progress_percentage . '%';
    }

    /**
     * Scope lấy các bài học đã hoàn thành
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed_at', '<>', null);
    }

    /**
     * Scope lấy các bài học đang tiến hành
     */
    public function scopeInProgress($query)
    {
        return $query->where('completed_at', null)
            ->where('progress_percentage', '>', 0);
    }

    /**
     * Scope lấy các bài học chưa bắt đầu
     */
    public function scopeNotStarted($query)
    {
        return $query->where('completed_at', null)
            ->where('progress_percentage', 0);
    }
} 