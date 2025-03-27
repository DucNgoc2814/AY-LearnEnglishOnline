<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmployeeRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'level'
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'is_active' => 'boolean',
        'level' => 'integer',
    ];

    /**
     * Lấy danh sách nhân viên có vai trò này
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_has_roles');
    }

    /**
     * Lấy danh sách quyền của vai trò
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(EmployeePermission::class, 'employee_role_permissions');
    }

    /**
     * Kiểm tra xem vai trò có quyền cụ thể không
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('slug', $permission)->exists();
    }

    /**
     * Gán nhiều quyền cho vai trò
     */
    public function givePermissionsTo(array $permissions): self
    {
        $permissionIds = EmployeePermission::whereIn('slug', $permissions)->pluck('id');
        $this->permissions()->syncWithoutDetaching($permissionIds);
        return $this;
    }

    /**
     * Xóa nhiều quyền khỏi vai trò
     */
    public function revokePermissionsTo(array $permissions): self
    {
        $permissionIds = EmployeePermission::whereIn('slug', $permissions)->pluck('id');
        $this->permissions()->detach($permissionIds);
        return $this;
    }

    /**
     * Đặt lại tất cả quyền cho vai trò
     */
    public function syncPermissions(array $permissions): self
    {
        $permissionIds = EmployeePermission::whereIn('slug', $permissions)->pluck('id');
        $this->permissions()->sync($permissionIds);
        return $this;
    }
} 