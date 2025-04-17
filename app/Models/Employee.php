<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Model implements JWTSubject
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_code',
        'name',
        'position',
        'department',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'is_active',
        'join_date',
        'resignation_date',
        'note'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'join_date' => 'date',
        'resignation_date' => 'date'
    ];


    /**
     * Lấy danh sách vai trò của nhân viên
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(EmployeeRole::class, 'employee_has_roles');
    }

    /**
     * Lấy danh sách quyền trực tiếp của nhân viên (không thông qua vai trò)
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(EmployeePermission::class, 'employee_has_permissions')
            ->withPivot('is_granted');
    }

    /**
     * Lấy tên đầy đủ của nhân viên
     */
    public function getNameAttribute($value)
    {
        return $value ?: $this->user->name;
    }

    /**
     * Kiểm tra xem nhân viên có vai trò cụ thể hay không
     */
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('slug', $role)->exists();
        }
        return $this->roles()->where('slug', $role)->exists();
    }

    /**
     * Kiểm tra xem nhân viên có quyền cụ thể hay không
     */
    public function hasPermission($permission): bool
    {
        return $this->permissions()
            ->where('slug', $permission)
            ->wherePivot('is_granted', true)
            ->exists();
    }

    /**
     * Tính tổng số ngày làm việc
     */
    public function getTotalWorkingDays(): int
    {
        $endDate = $this->resignation_date ?? now();
        return $this->join_date->diffInDays($endDate);
    }


    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }

    public function scopeByPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    // Methods
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = EmployeeRole::where('slug', $role)->firstOrFail();
        }
        if (!$this->hasRole($role->slug)) {
            $this->roles()->attach($role->id);
        }
    }

    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = EmployeeRole::where('slug', $role)->firstOrFail();
        }
        $this->roles()->detach($role->id);
    }

    public function grantPermission($permission)
    {
        if (is_string($permission)) {
            $permission = EmployeePermission::where('slug', $permission)->firstOrFail();
        }
        $this->permissions()->syncWithoutDetaching([
            $permission->id => ['is_granted' => true]
        ]);
    }

    public function revokePermission($permission)
    {
        if (is_string($permission)) {
            $permission = EmployeePermission::where('slug', $permission)->firstOrFail();
        }
        $this->permissions()->detach($permission->id);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user_type' => 'employee',
            'employee_code' => $this->employee_code,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles->pluck('slug')->toArray()
        ];
    }
}
