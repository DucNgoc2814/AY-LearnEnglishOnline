<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'categoryId',
        'name',
        'slug',
        'description',
        'sortDescription',
        'price',
        'salePrice',
        'thumbnail',
        'totalStudent',
        'rating',
        'totalRating',
        'releaseTime',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'salePrice' => 'decimal:2',
        'releaseTime' => 'datetime',
        'type' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'courseId');
    }

    public function zoomSessions()
    {
        return $this->hasMany(ZoomSession::class, 'lessonId');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class,'courseId');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'courseId');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'courseId');
    }


    public function finalExams()
    {
        return $this->hasMany(FinalExam::class);
    }

    public function totalLessons()
    {
        return $this->lessons()->count() ;
    }

    public function totalEnrollments()
    {
        return $this->enrollments()->count();
    }

    public function totalRevenue()
    {
        return $this->orders()
            ->where('orderStatusId', 3) 
            ->sum('paymentAmount');
    }
    public function totalDuration()
    {
        $totalSeconds = $this->lessons()
            ->join('video_lessons', 'lessons.id', '=', 'video_lessons.lessonId')
            ->sum('video_lessons.duration');

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
