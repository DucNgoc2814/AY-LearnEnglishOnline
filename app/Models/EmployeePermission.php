<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmployeePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'module',
        'action',
        'is_system',
        'is_active'
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Lấy danh sách vai trò có quyền này
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(EmployeeRole::class, 'employee_role_permissions');
    }

    /**
     * Lấy danh sách nhân viên được cấp trực tiếp quyền này
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_has_permissions')
            ->withPivot('is_granted');
    }

    /**
     * Lấy danh sách nhân viên có quyền này (thông qua vai trò hoặc cấp trực tiếp)
     */
    public function getEmployeesWithPermissionAttribute()
    {
        // Lấy nhân viên được cấp trực tiếp quyền này
        $directEmployees = $this->employees()->wherePivot('is_granted', true)->get();

        // Lấy nhân viên có quyền thông qua vai trò
        $roleEmployeeIds = $this->roles()
            ->with('employees')
            ->get()
            ->pluck('employees')
            ->flatten()
            ->pluck('id')
            ->unique();

        $roleEmployees = Employee::whereIn('id', $roleEmployeeIds)->get();

        // Kết hợp hai tập hợp và loại bỏ trùng lặp
        return $directEmployees->merge($roleEmployees)->unique('id');
    }

    /**
     * Kiểm tra xem quyền có thuộc module nào đó không
     */
    public function isInModule(string $module): bool
    {
        return $this->module === $module;
    }

    /**
     * Scope lọc quyền theo module
     */
    public function scopeInModule($query, string $module)
    {
        return $query->where('module', $module);
    }

    /**
     * Scope lọc quyền theo action
     */
    public function scopeWithAction($query, string $action)
    {
        return $query->where('action', $action);
    }
}
