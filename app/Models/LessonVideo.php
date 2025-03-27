<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'video_url',
        'duration',
        'thumbnail_url',
        'order',
        'is_preview',
        'status',
        'provider',
        'provider_video_id',
        'meta_data'
    ];

    protected $casts = [
        'duration' => 'integer',
        'order' => 'integer',
        'is_preview' => 'boolean',
        'meta_data' => 'json'
    ];

    // Relationships
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(VideoProgress::class);
    }

    // Methods
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

    public function isYoutube(): bool
    {
        return $this->provider === 'youtube';
    }

    public function isVimeo(): bool
    {
        return $this->provider === 'vimeo';
    }

    public function isSelfHosted(): bool
    {
        return $this->provider === 'local';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }
} 