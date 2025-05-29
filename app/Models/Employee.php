<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'employee_code',
        'name',
        'position',
        'department',
        'email',
        'password',
        'phone',
        'address',
        'is_active',
        'join_date',
        'resignation_date',
        'role',
        'note',
        'device_id',
        'browser_id',
        'last_active_at',
        'active_token',
        'refresh_token',
        'is_testing',
        'login_lock',
        'login_lock_expires_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'active_token',
        'refresh_token'
    ];

    protected $casts = [
        'join_date' => 'date',
        'resignation_date' => 'date',
        'last_active_at' => 'datetime',
        'login_lock_expires_at' => 'datetime',
        'is_testing' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(EmployeeRole::class, 'employee_has_roles');
    }
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(EmployeePermission::class, 'employee_has_permissions')
            ->withPivot('is_granted');
    }
    public function getNameAttribute($value)
    {
        return $value ?: $this->user->name;
    }
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('slug', $role)->exists();
        }
        return $this->roles()->where('slug', $role)->exists();
    }
    public function hasPermission($permission): bool
    {
        return $this->permissions()
            ->where('slug', $permission)
            ->wherePivot('is_granted', true)
            ->exists();
    }
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
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [
            'user_type' => 'employee',
            'role' => $this->role,
            'employee_code' => $this->employee_code,
            'email' => $this->email
        ];
    }

    /**
     * Check if employee is locked
     */
    public function isLocked(): bool
    {
        if (!$this->login_lock || !$this->login_lock_expires_at) {
            return false;
        }

        return $this->login_lock_expires_at->isFuture();
    }

    /**
     * Check if employee can login from device
     */
    public function canLoginFromDevice(string $deviceId): bool
    {
        if (!$this->device_id) {
            return true;
        }

        return $this->device_id === $deviceId;
    }

    /**
     * Lock employee for login
     */
    public function lock(string $lockId, int $seconds = 10): void
    {
        $this->update([
            'login_lock' => $lockId,
            'login_lock_expires_at' => now()->addSeconds($seconds)
        ]);
    }

    /**
     * Unlock employee
     */
    public function unlock(): void
    {
        $this->update([
            'login_lock' => null,
            'login_lock_expires_at' => null
        ]);
    }

    /**
     * Register device for employee
     */
    public function registerDevice(string $deviceId, string $token): void
    {
        $this->update([
            'device_id' => $deviceId,
            'active_token' => $token,
            'last_active_at' => now()
        ]);
    }

    /**
     * Unregister device
     */
    public function unregisterDevice(): void
    {
        $this->update([
            'device_id' => null,
            'active_token' => null,
            'last_active_at' => null
        ]);
    }
}
