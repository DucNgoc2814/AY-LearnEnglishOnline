<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'total_courses',
        'completed_courses',
        'total_lessons',
        'completed_lessons',
        'total_activities',
        'completed_activities',
        'total_points',
        'average_score',
        'learning_time',
        'last_activity_at',
        'meta_data'
    ];

    protected $casts = [
        'total_courses' => 'integer',
        'completed_courses' => 'integer',
        'total_lessons' => 'integer',
        'completed_lessons' => 'integer',
        'total_activities' => 'integer',
        'completed_activities' => 'integer',
        'total_points' => 'float',
        'average_score' => 'float',
        'learning_time' => 'integer',
        'last_activity_at' => 'datetime',
        'meta_data' => 'array'
    ];

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Methods
    public function updateProgress()
    {
        $student = $this->student;

        $this->total_courses = $student->enrollments()->count();
        $this->completed_courses = $student->enrollments()->where('status', 'completed')->count();

        $this->total_lessons = $student->enrollments()
            ->withCount('lessons')
            ->get()
            ->sum('lessons_count');

        $this->completed_lessons = $student->enrollments()
            ->withCount(['lessons' => function ($query) {
                $query->whereHas('progress', function ($q) {
                    $q->where('status', 'completed');
                });
            }])
            ->get()
            ->sum('lessons_count');

        $this->total_activities = $student->activityResults()->count();
        $this->completed_activities = $student->activityResults()->where('status', 'completed')->count();

        $this->total_points = $student->activityResults()->sum('points');
        $this->average_score = $student->activityResults()
            ->where('status', 'completed')
            ->avg('points') ?? 0;

        $this->last_activity_at = now();
        $this->save();
    }

    public function getCompletionRate(): float
    {
        if ($this->total_courses === 0) {
            return 0;
        }
        return round(($this->completed_courses / $this->total_courses) * 100, 2);
    }

    public function getLessonCompletionRate(): float
    {
        if ($this->total_lessons === 0) {
            return 0;
        }
        return round(($this->completed_lessons / $this->total_lessons) * 100, 2);
    }

    public function getActivityCompletionRate(): float
    {
        if ($this->total_activities === 0) {
            return 0;
        }
        return round(($this->completed_activities / $this->total_activities) * 100, 2);
    }

    public function getFormattedLearningTime(): string
    {
        $hours = floor($this->learning_time / 60);
        $minutes = $this->learning_time % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }
} 