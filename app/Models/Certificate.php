<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'userId',
        'courseId',
        'certificateNumber',
        'issueDate',
        'file',
        'status',
        'note',
        'approvedBy',
        'approvedAt',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function approvedByUser()
    {
        return $this->belongsTo(Employee::class, 'approvedBy');
    }
}
