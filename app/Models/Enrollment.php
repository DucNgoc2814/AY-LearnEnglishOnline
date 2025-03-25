<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'class_id',
        'enrollment_type',
        'enrollment_date',
        'expiration_date',
        'progress_percentage',
        'last_activity_date',
        'completed_date',
        'certificate_issued',
        'certificate_url',
        'payment_status',
        'payment_method',
        'amount_paid',
        'transaction_id',
        'invoice_id',
        'discount_applied',
        'status',
        'notes',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'course_id' => 'integer',
        'class_id' => 'integer',
        'enrollment_date' => 'datetime',
        'expiration_date' => 'datetime',
        'progress_percentage' => 'decimal:2',
        'last_activity_date' => 'datetime',
        'completed_date' => 'datetime',
        'certificate_issued' => 'boolean',
        'amount_paid' => 'decimal:2',
        'discount_applied' => 'decimal:2',
    ];

    /**
     * Get the user associated with this enrollment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the course associated with this enrollment
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the class associated with this enrollment
     */
    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    /**
     * Check if the enrollment is for a course
     */
    public function isForCourse(): bool
    {
        return $this->enrollment_type === 'course' || is_null($this->class_id);
    }

    /**
     * Check if the enrollment is for a class
     */
    public function isForClass(): bool
    {
        return $this->enrollment_type === 'class' || !is_null($this->class_id);
    }

    /**
     * Check if the enrollment is paid
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Check if the enrollment is active
     */
    public function isActive(): bool
    {
        // Enrollment is not active if status is not 'active'
        if ($this->status !== 'active') {
            return false;
        }
        
        // Check if enrollment has expired
        if ($this->expiration_date && Carbon::now()->gt($this->expiration_date)) {
            return false;
        }
        
        // Check if enrollment is completed
        if ($this->completed_date) {
            return false;
        }
        
        return true;
    }

    /**
     * Check if the enrollment is completed
     */
    public function isCompleted(): bool
    {
        return !is_null($this->completed_date) || $this->progress_percentage >= 100;
    }

    /**
     * Check if the certificate has been issued
     */
    public function hasCertificate(): bool
    {
        return $this->certificate_issued && !empty($this->certificate_url);
    }

    /**
     * Update the enrollment progress based on completed lessons
     */
    public function updateProgress(): float
    {
        // Only relevant for course enrollments
        if (!$this->isForCourse()) {
            return $this->progress_percentage;
        }
        
        $course = $this->course;
        if (!$course) {
            return $this->progress_percentage;
        }
        
        $totalLessons = $course->lessons()->count();
        if ($totalLessons === 0) {
            return 0;
        }
        
        $completedLessons = LessonProgress::where('user_id', $this->user_id)
            ->whereIn('lesson_id', $course->lessons()->pluck('id'))
            ->where('is_completed', true)
            ->count();
        
        $progress = ($completedLessons / $totalLessons) * 100;
        $this->progress_percentage = $progress;
        $this->last_activity_date = Carbon::now();
        
        // If completed, set completion date
        if ($progress >= 100 && !$this->completed_date) {
            $this->completed_date = Carbon::now();
        }
        
        $this->save();
        
        return $progress;
    }
} 