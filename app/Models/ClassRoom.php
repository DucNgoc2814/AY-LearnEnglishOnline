<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

class ClassRoom extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'instructor_id',
        'name',
        'class_code',
        'description',
        'class_type',
        'start_date',
        'end_date',
        'schedule_details',
        'location',
        'max_students',
        'current_students',
        'status',
        'is_active',
        'enrollment_deadline',
        'min_students',
        'fee',
    ];

    protected $casts = [
        'course_id' => 'integer',
        'instructor_id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'schedule_details' => 'json',
        'max_students' => 'integer',
        'current_students' => 'integer',
        'is_active' => 'boolean',
        'enrollment_deadline' => 'date',
        'min_students' => 'integer',
        'fee' => 'decimal:2',
    ];

    /**
     * Get the course that this class belongs to
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the instructor for this class
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get all enrollments for this class
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'class_id');
    }

    /**
     * Get all online rooms for this class
     */
    public function onlineRooms(): MorphMany
    {
        return $this->morphMany(OnlineRoom::class, 'roomable');
    }

    /**
     * Get all attendances for this class
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'class_id');
    }

    /**
     * Get all class sessions for this class
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(ClassSession::class, 'class_id');
    }

    /**
     * Check if this class is online or hybrid
     */
    public function isOnline(): bool
    {
        return $this->class_type === 'online' || $this->class_type === 'hybrid';
    }

    /**
     * Check if this class is offline or hybrid
     */
    public function isOffline(): bool
    {
        return $this->class_type === 'offline' || $this->class_type === 'hybrid';
    }

    /**
     * Check if this class is currently open for enrollment
     */
    public function isOpenForEnrollment(): bool
    {
        $now = Carbon::now();
        
        // Check if class is active and not full
        $isActiveAndNotFull = $this->is_active && 
                             $this->status === 'active' && 
                             ($this->current_students < $this->max_students || is_null($this->max_students));
        
        // Check if we're still before the enrollment deadline
        $beforeDeadline = is_null($this->enrollment_deadline) || $now->lt($this->enrollment_deadline);
        
        // Check if the class hasn't started yet
        $hasNotStarted = $now->lt($this->start_date);
        
        return $isActiveAndNotFull && $beforeDeadline && $hasNotStarted;
    }

    /**
     * Calculate how many spots are left for enrollment
     * Returns null if unlimited
     */
    public function spotsLeft(): ?int
    {
        if (is_null($this->max_students)) {
            return null;
        }
        
        return max(0, $this->max_students - $this->current_students);
    }

    /**
     * Get upcoming class sessions
     */
    public function upcomingSessions()
    {
        $now = Carbon::now();
        
        return $this->sessions()
                    ->where('session_date', '>=', $now->format('Y-m-d'))
                    ->orderBy('session_date')
                    ->orderBy('start_time');
    }
} 