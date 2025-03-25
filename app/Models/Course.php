<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'short_description',
        'course_type',
        'course_format',
        'price',
        'sale_price',
        'estimated_hours',
        'has_certificate',
        'requires_enrollment',
        'thumbnail',
        'preview_video',
        'total_students',
        'rating',
        'total_ratings',
        'course_outline',
        'requirements',
        'learning_outcomes',
        'release_date',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'release_date' => 'datetime',
        'estimated_hours' => 'integer',
        'has_certificate' => 'boolean',
        'requires_enrollment' => 'boolean',
        'total_students' => 'integer',
        'rating' => 'decimal:2',
        'total_ratings' => 'integer',
        'course_outline' => 'json',
        'requirements' => 'json',
        'learning_outcomes' => 'json',
        'order' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    /**
     * Get the category this course belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get all lessons for this course
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }

    /**
     * Get all online rooms for this course
     */
    public function onlineRooms(): MorphMany
    {
        return $this->morphMany(OnlineRoom::class, 'roomable');
    }

    /**
     * Get all enrollments for this course
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    /**
     * Get all ratings for this course
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'course_id');
    }

    /**
     * Get all orders for this course
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'course_id');
    }

    /**
     * Get all final exams for this course
     */
    public function finalExams(): HasMany
    {
        return $this->hasMany(FinalExam::class, 'course_id');
    }

    /**
     * Get all classes for this course
     */
    public function classes(): HasMany
    {
        return $this->hasMany(ClassRoom::class, 'course_id');
    }

    /**
     * Get all resources for this course
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    /**
     * Calculate the total number of lessons
     */
    public function totalLessons(): int
    {
        return $this->lessons()->count();
    }

    /**
     * Calculate the total number of enrollments
     */
    public function totalEnrollments(): int
    {
        return $this->enrollments()->count();
    }

    /**
     * Calculate the total revenue from orders
     */
    public function totalRevenue(): float
    {
        return $this->orders()
            ->where('orderStatusId', 3)
            ->sum('paymentAmount');
    }

    /**
     * Calculate the total duration of all videos in the course
     */
    public function totalDuration(): string
    {
        $totalSeconds = $this->lessons()
            ->join('resources', function($join) {
                $join->on('lessons.id', '=', 'resources.resourceable_id')
                    ->where('resourceable_type', 'App\\Models\\Lesson')
                    ->where('file_type', 'video');
            })
            ->sum('resources.duration');
            
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    /**
     * Calculate the total number of tests in the course
     */
    public function totalTests(): int
    {
        $lessons = $this->lessons()->get();
        $lessonTests = $lessons->sum(function($lesson) {
            return $lesson->totalTests();
        });
        $finalTests = $this->finalExams()->count();
        return $lessonTests + $finalTests;
    }

    /**
     * Check if a user is enrolled in this course
     */
    public function isEnrolledByUser($userId): bool
    {
        return $this->enrollments()
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->exists();
    }

    /**
     * Check if this course requires enrollment in a class
     */
    public function requiresClass(): bool
    {
        return $this->course_type === 'instructor_led' || 
               ($this->course_type === 'hybrid' && $this->requires_enrollment);
    }
    
    /**
     * Check if this course is self-paced (can be studied independently)
     */
    public function isSelfPaced(): bool
    {
        return $this->course_type === 'self_paced' || $this->course_type === 'hybrid';
    }
    
    /**
     * Get available classes for this course
     */
    public function availableClasses()
    {
        return $this->hasMany(ClassRoom::class, 'course_id')
            ->where('status', 'active')
            ->where('start_date', '>', now())
            ->where('is_active', true)
            ->where(function($query) {
                $query->where('current_students', '<', 'max_students')
                      ->orWhereNull('max_students');
            });
    }
}
