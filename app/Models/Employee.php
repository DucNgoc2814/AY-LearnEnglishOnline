<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employeeCode',
        'name',
        'position',
        'department',
        'note'
    ];

    protected $casts = [
        'employeeCode' => 'string'
    ];
} 