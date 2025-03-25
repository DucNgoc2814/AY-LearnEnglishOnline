<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneNumber',
        'birthDate',
        'authGoogleId',
        'role',
        'roleToken',
        'refreshToken'
    ];

    protected $hidden = [
        'password',
        'roleToken',
        'refreshToken'
    ];

    protected $casts = [
        'birthDate' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function lessonResults()
    {
        return $this->hasMany(LessonResult::class);
    }
    /**
     * Lấy tổng số khóa học đã đăng ký
     *
     * @return int
     */
    public function getTotalCoursesAttribute()
    {
        return $this->enrollments()->count();
    }

    /**
     * Lấy tổng số khóa học đã hoàn thành
     *
     * @return int
     */
    public function getCompletedCoursesAttribute()
    {
        return $this->enrollments()
            ->where('status', 'completed')
            ->count();
    }

    public function hasEnrolledCourse($courseId)
    {
        return $this->enrollments()
            ->where('course_id', $courseId)
            ->where('status', 'active')
            ->exists();
    }
}
