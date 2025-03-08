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
        return $this->hasMany(Enrollment::class);
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


}
