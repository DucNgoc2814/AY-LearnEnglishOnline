<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'code',
        'course_id',
        'teacher_id',
        'class_type',
        'start_date',
        'end_date',
        'enrollment_deadline',
        'max_students',
        'min_students',
        'fee',
        'current_students',
        'status',
        'description',
        'schedule',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'enrollment_deadline' => 'date',
        'schedule' => 'array',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Employee::class, 'teacher_id');
    }

    public function assistant()
    {
        return $this->belongsTo(Employee::class, 'assistant_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student');
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'class_id');
    }
} 