<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'file_extension',
        'file_url',
        'external_url',
        'duration',
        'preview_path',
        'resourceable_id',
        'resourceable_type',
        'category',
        'is_downloadable',
        'is_active',
        'is_featured',
        'order',
        'resource_level',
        'access_type',
        'original_lesson_video_id',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'duration' => 'integer',
        'resourceable_id' => 'integer',
        'is_downloadable' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'original_lesson_video_id' => 'integer',
    ];

    /**
     * Get the parent resourceable model
     */
    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the original lesson video this resource was created from
     */
    public function originalLessonVideo(): BelongsTo
    {
        return $this->belongsTo(LessonVideo::class, 'original_lesson_video_id');
    }

    /**
     * Get all attendance details for this resource
     */
    public function attendanceDetails(): HasMany
    {
        return $this->hasMany(OnlineAttendanceDetail::class, 'resource_id');
    }

    /**
     * Get all learning logs for this resource
     */
    public function learningLogs(): HasMany
    {
        return $this->hasMany(LearningLog::class, 'resource_id');
    }

    /**
     * Check if this resource is a video
     */
    public function isVideo(): bool
    {
        return $this->file_type === 'video';
    }

    /**
     * Check if this resource is a document
     */
    public function isDocument(): bool
    {
        return in_array($this->file_type, ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx']);
    }

    /**
     * Check if this resource is an audio
     */
    public function isAudio(): bool
    {
        return $this->file_type === 'audio';
    }

    /**
     * Check if this resource is an image
     */
    public function isImage(): bool
    {
        return $this->file_type === 'image';
    }

    /**
     * Check if this resource is free (no enrollment required)
     */
    public function isFree(): bool
    {
        return $this->access_type === 'free';
    }

    /**
     * Check if this resource requires enrollment
     */
    public function requiresEnrollment(): bool
    {
        return $this->access_type === 'enrolled' || $this->access_type === 'premium';
    }

    /**
     * Check if this resource is premium (requires payment)
     */
    public function isPremium(): bool
    {
        return $this->access_type === 'premium';
    }

    /**
     * Get the formatted duration
     */
    public function getDurationFormatted(): string
    {
        $seconds = $this->duration;
        
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $remainingSeconds);
        } else {
            return sprintf('%d:%02d', $minutes, $remainingSeconds);
        }
    }

    /**
     * Get the formatted file size
     */
    public function getFormattedFileSize(): string
    {
        $size = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $i = 0;
        while ($size >= 1024 && $i < count($units) - 1) {
            $size /= 1024;
            $i++;
        }
        
        return round($size, 2) . ' ' . $units[$i];
    }

    /**
     * Get completion statistics for this resource
     */
    public function getCompletionStats(): array
    {
        $totalUsers = 0;
        $completedUsers = 0;
        $avgProgress = 0;
        
        if ($this->isVideo()) {
            $totalUsers = $this->attendanceDetails()->count('DISTINCT user_id');
            $completedUsers = $this->attendanceDetails()
                ->where('is_completed', true)
                ->count('DISTINCT user_id');
            $avgProgress = $this->attendanceDetails()->avg('view_progress') ?? 0;
        } else {
            $totalUsers = $this->learningLogs()->count('DISTINCT user_id');
            $completedUsers = $this->learningLogs()
                ->where('is_completed', true)
                ->count('DISTINCT user_id');
            $avgProgress = $this->learningLogs()->avg('progress_percentage') ?? 0;
        }
        
        return [
            'total_users' => $totalUsers,
            'completed_users' => $completedUsers,
            'completion_rate' => $totalUsers > 0 ? ($completedUsers / $totalUsers) * 100 : 0,
            'average_progress' => round($avgProgress, 2)
        ];
    }
} 