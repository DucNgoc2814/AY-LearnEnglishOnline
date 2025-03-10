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
    /**
     * Tính tổng doanh thu của khóa học
     * 
     * @return float
     */
    public function totalRevenue()
    {
        return $this->enrollments()
            ->whereHas('order', function($query) {
                $query->where('status', 'completed');
            })
            ->sum('price');
    }
}
