<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class LessonVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lesson_id',
        'name',
        'slug',
        'video_url',
        'duration',
        'video_type',
        'thumbnail_url',
        'is_downloadable',
        'is_preview',
        'view_count'
    ];

    protected $casts = [
        'duration' => 'integer',
        'is_downloadable' => 'boolean',
        'is_preview' => 'boolean',
        'view_count' => 'integer'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lessonVideo) {
            if (empty($lessonVideo->slug)) {
                $lessonVideo->slug = Str::slug($lessonVideo->name);
            }
        });

        static::updating(function ($lessonVideo) {
            if ($lessonVideo->isDirty('name')) {
                $lessonVideo->slug = Str::slug($lessonVideo->name);
            }
        });
    }

    // Relationships

    /**
     * Bài học mà video thuộc về
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Tiến trình xem video của học viên
     */
    public function progress(): HasMany
    {
        return $this->hasMany(VideoProgress::class);
    }

    // Methods

    /**
     * Định dạng thời lượng video dưới dạng HH:MM:SS
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Tăng số lượt xem video
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    // Scopes

    /**
     * Lấy các video có thể xem trước
     */
    public function scopePreviewable($query)
    {
        return $query->where('is_preview', true);
    }

    /**
     * Lấy các video theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}
