<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnlineSessionRecording extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'online_room_id',
        'title',
        'description',
        'recording_url',
        'download_url',
        'duration_minutes',
        'recorded_at',
        'recording_type',
        'file_size',
        'chapters',
        'transcript',
        'is_processed',
        'requires_authentication',
        'downloadable',
        'view_count',
        'is_active',
        'original_video_record_id',
    ];

    protected $casts = [
        'online_room_id' => 'integer',
        'duration_minutes' => 'integer',
        'recorded_at' => 'datetime',
        'file_size' => 'integer',
        'chapters' => 'json',
        'transcript' => 'json',
        'is_processed' => 'boolean',
        'requires_authentication' => 'boolean',
        'downloadable' => 'boolean',
        'view_count' => 'integer',
        'is_active' => 'boolean',
        'original_video_record_id' => 'integer',
    ];

    /**
     * Get the online room this recording belongs to
     */
    public function onlineRoom(): BelongsTo
    {
        return $this->belongsTo(OnlineRoom::class, 'online_room_id');
    }

    /**
     * Get all views for this recording
     */
    public function views(): HasMany
    {
        return $this->hasMany(RecordingView::class, 'recording_id');
    }

    /**
     * Check if the recording is viewable by the given user
     */
    public function isViewableBy(User $user): bool
    {
        // If recording doesn't require authentication, it's viewable by all
        if (!$this->requires_authentication) {
            return true;
        }

        // Check if recording is active
        if (!$this->is_active) {
            return false;
        }

        // Get the online room
        $room = $this->onlineRoom;
        
        // If room doesn't exist, not viewable
        if (!$room) {
            return false;
        }

        // Get the roomable entity (course or class)
        $roomable = $room->roomable;
        
        // If roomable doesn't exist, not viewable
        if (!$roomable) {
            return false;
        }

        // If admin or instructor of the room, allow viewing
        if ($user->hasRole(['admin', 'instructor']) && 
            ($roomable->instructor_id == $user->id || $user->hasRole('admin'))) {
            return true;
        }

        // Check if user is enrolled in the course/class
        if ($roomable instanceof Course) {
            return $roomable->isEnrolledByUser($user->id);
        } elseif ($roomable instanceof ClassRoom) {
            return $roomable->enrollments()
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->exists();
        }

        return false;
    }

    /**
     * Get the formatted duration of the recording
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d hours', $hours, $minutes);
        } else {
            return sprintf('%d minutes', $minutes);
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
     * Get completion statistics for this recording
     */
    public function getCompletionStats(): array
    {
        $totalViews = $this->views()->count();
        $completedViews = $this->views()
            ->where('completion_percentage', '>=', 90)
            ->count();
            
        $avgCompletion = $this->views()
            ->avg('completion_percentage') ?? 0;
            
        return [
            'total_views' => $totalViews,
            'completed_views' => $completedViews,
            'completion_rate' => $totalViews > 0 ? ($completedViews / $totalViews) * 100 : 0,
            'avg_completion' => round($avgCompletion, 2),
        ];
    }

    /**
     * Record a view of this recording by a user
     */
    public function recordView(User $user, float $completionPercentage = 0): RecordingView
    {
        $view = RecordingView::firstOrNew([
            'recording_id' => $this->id,
            'user_id' => $user->id,
            'session_id' => session()->getId(),
        ]);
        
        $view->completion_percentage = max($view->completion_percentage ?? 0, $completionPercentage);
        $view->view_count = ($view->view_count ?? 0) + 1;
        $view->last_viewed_at = now();
        $view->device_info = [
            'user_agent' => request()->userAgent(),
            'ip' => request()->ip(),
        ];
        
        $view->save();
        
        // Update the overall view count
        $this->increment('view_count');
        
        return $view;
    }
} 