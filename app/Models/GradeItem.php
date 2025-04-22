<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'student_id',
        'test_id',
        'session_id',
        'item_name',
        'description',
        'score',
        'max_score',
        'grade_type',
        'grade_date',
        'feedback',
        'is_published'
    ];

    protected $casts = [
        'score' => 'float',
        'max_score' => 'float',
        'is_published' => 'boolean',
        'grade_date' => 'datetime'
    ];

    /**
     * Get the class that this grade belongs to
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Get the student that this grade belongs to
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Get the session that this grade belongs to
     */
    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }
    
    /**
     * Get the test associated with this grade item
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
    
    /**
     * Get the tests related to this grade item through the pivot table
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'grade_item_test')
                    ->withPivot('metadata')
                    ->withTimestamps();
    }
    
    /**
     * Calculate the percentage score
     */
    public function getPercentageAttribute()
    {
        if ($this->max_score > 0) {
            return round(($this->score / $this->max_score) * 100, 1);
        }
        return 0;
    }
}
