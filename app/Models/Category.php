<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'categoryId');
    }

    /**
     * Get total number of courses in this category
     * 
     * @return int
     */
    public function totalCourses()
    {
        return $this->courses()->count();
    }
} 