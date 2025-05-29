<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'birth_date',
        'auth_facebook_id',
        'auth_type',
        'role',
        'device_id',
        'browser_id',
        'last_active_at',
        'active_token',
        'refresh_token',
        'is_testing',
        'login_lock',
        'login_lock_expires_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'active_token',
        'refresh_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        'last_active_at' => 'datetime',
        'login_lock_expires_at' => 'datetime',
        'is_testing' => 'boolean'
    ];

    // Relationships
    public function student()
    {
        return $this->hasOne(Student::class);
    }


    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function learningLogs()
    {
        return $this->hasMany(LearningLog::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    // Scopes
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeRegularUsers($query)
    {
        return $query->where('role', 'user');
    }

    // Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function hasPermission($permission): bool
    {
        // Thực hiện kiểm tra quyền
        return true;
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
            'user_type' => 'user',
            'role' => $this->role,
            'email' => $this->email
        ];
    }

    /**
     * Check if user is locked
     */
    public function isLocked(): bool
    {
        if (!$this->login_lock || !$this->login_lock_expires_at) {
            return false;
        }

        return $this->login_lock_expires_at->isFuture();
    }

    /**
     * Check if user can login from device
     */
    public function canLoginFromDevice(string $deviceId): bool
    {
        if (!$this->device_id) {
            return true;
        }

        return $this->device_id === $deviceId;
    }

    /**
     * Lock user for login
     */
    public function lock(string $lockId, int $seconds = 10): void
    {
        $this->update([
            'login_lock' => $lockId,
            'login_lock_expires_at' => now()->addSeconds($seconds)
        ]);
    }

    /**
     * Unlock user
     */
    public function unlock(): void
    {
        $this->update([
            'login_lock' => null,
            'login_lock_expires_at' => null
        ]);
    }

    /**
     * Register device for user
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
