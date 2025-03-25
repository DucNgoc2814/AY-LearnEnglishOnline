<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'userId',
        'studentCode',
        'fullName',
        'dateOfBirth',
        'gender',
        'phone',
        'address',
        'avatar',
        'bio',
        'parent1Name',
        'parent1Relationship',
        'parent1Phone',
        'parent1Email',
        'parent1Occupation',
        'parent1IsEmergencyContact',
        'parent2Name',
        'parent2Relationship',
        'parent2Phone',
        'parent2Email',
        'parent2Occupation',
        'parent2IsEmergencyContact',
        'isActive'
    ];

    protected $casts = [
        'dateOfBirth' => 'date',
        'parent1IsEmergencyContact' => 'boolean',
        'parent2IsEmergencyContact' => 'boolean',
        'isActive' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(ClassRoom::class, 'class_student', 'studentId', 'classId')
            ->withPivot('status', 'enrollmentDate', 'completionDate', 'notes')
            ->withTimestamps();
    }
} 