<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'video_progress';

    protected $fillable = [
        'user_id',
        'video_id',
        'current_time',
        'completed',
        'last_watched_at',
        'watch_count',
        'meta_data'
    ];

    protected $casts = [
        'current_time' => 'integer',
        'completed' => 'boolean',
        'last_watched_at' => 'datetime',
        'watch_count' => 'integer',
        'meta_data' => 'json'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(LessonVideo::class, 'video_id');
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    public function scopeInProgress($query)
    {
        return $query->where('completed', false)->where('current_time', '>', 0);
    }

    // Methods
    public function markAsCompleted(): self
    {
        $this->completed = true;
        $this->save();
        
        return $this;
    }

    public function updateProgress($currentTime, $duration = null): self
    {
        $this->current_time = $currentTime;
        $this->last_watched_at = now();
        
        if ($duration) {
            $this->duration = $duration;
        }
        
        // Nếu đã xem hơn 90% video thì đánh dấu là hoàn thành
        if ($this->duration > 0 && ($currentTime / $this->duration) >= 0.9) {
            $this->markAsCompleted();
        } else {
            $this->save();
        }
        
        return $this;
    }

    public function getProgressPercentage(): int
    {
        if ($this->duration <= 0) {
            return 0;
        }
        
        return min(100, round(($this->current_time / $this->duration) * 100));
    }

    public function getFormattedCurrentTime(): string
    {
        $minutes = floor($this->current_time / 60);
        $seconds = $this->current_time % 60;
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
} 