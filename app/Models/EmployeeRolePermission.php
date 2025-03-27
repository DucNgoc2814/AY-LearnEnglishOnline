<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeRolePermission extends Model
{
    protected $table = 'employee_role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(EmployeeRole::class);
    }

    public function permission()
    {
        return $this->belongsTo(EmployeePermission::class);
    }
} 