<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseRegistrationStudent extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_registration_student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'course_registration_id',
        'student_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the course registration that owns the pivot.
     */
    public function courseRegistration()
    {
        return $this->belongsTo(CourseRegistration::class);
    }

    /**
     * Get the student that owns the pivot.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
