<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'type', 'learningPath', 'categoryId', 'lessons', 'paymentContent', 'totalRating'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function finalExam()
    {
        return $this->hasOne(FinalExam::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
