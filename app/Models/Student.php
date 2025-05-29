<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'student_code',
        'password',
        'full_name',
        'email',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'avatar',
        'bio',
        'auth_type',
        'activation_token',
        'activated_at',
        'device_id',
        'browser_id',
        'last_active_at',
        'active_token',
        'refresh_token',
        'is_testing',
        'login_lock',
        'login_lock_expires_at',
        'parent1_name',
        'parent1_relationship',
        'parent1_phone',
        'parent1_email',
        'parent1_occupation',
        'parent1_is_emergency_contact',
        'parent2_name',
        'parent2_relationship',
        'parent2_phone',
        'parent2_email',
        'parent2_occupation',
        'parent2_is_emergency_contact',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'active_token',
        'refresh_token',
        'activation_token'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'activated_at' => 'datetime',
        'last_active_at' => 'datetime',
        'login_lock_expires_at' => 'datetime',
        'is_testing' => 'boolean',
        'parent1_is_emergency_contact' => 'boolean',
        'parent2_is_emergency_contact' => 'boolean',
        'is_active' => 'boolean'
    ];

    /**
     * Automatically hash passwords when they are set
     */

    /**
     * Get the username field for authentication
     */
    public function username()
    {
        return 'student_code';
    }

    /**
     * Get the user that owns the student profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the classes the student is enrolled in.
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class, 'course_registrations', 'student_id', 'class_id')
            ->withPivot(['status', 'fee_amount', 'payment_status', 'payment_method', 'payment_date', 'invoice_number', 'enrollment_date', 'completion_date', 'notes'])
            ->withTimestamps();
    }

    /**
     * Get the attendances for the student.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the grades for the student.
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Lấy danh sách kết quả hoạt động của học viên
     */
    public function activityResults(): HasMany
    {
        return $this->hasMany(ActivityResult::class);
    }

    /**
     * Lấy tên đầy đủ của học viên
     */
    public function getFullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Kiểm tra xem học viên đã tham gia lớp học nào chưa
     */
    public function isEnrolledInClass($classId): bool
    {
        return $this->classes()->where('classes.id', $classId)->exists();
    }

    /**
     * Tính tỷ lệ tham gia lớp học
     */
    public function getAttendanceRate($classId): float
    {
        $classSessionsCount = ClassSession::where('class_id', $classId)->count();

        if ($classSessionsCount === 0) {
            return 0;
        }

        $attendedCount = $this->attendances()
            ->whereHas('session', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })
            ->whereIn('status', ['present', 'late'])
            ->count();

        return ($attendedCount / $classSessionsCount) * 100;
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function learningProgress(): HasOne
    {
        return $this->hasOne(LearningProgress::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Methods
    public function getAvatarUrl(): string
    {
        if ($this->avatar) {
            if (config('filesystems.disks.cloudfront.domain')) {
                return 'https://' . config('filesystems.disks.cloudfront.domain') . '/' . $this->avatar;
            }
            // Fallback to S3 URL if CloudFront is not configured
            $bucket = config('filesystems.disks.s3.bucket');
            $region = config('filesystems.disks.s3.region');
            return "https://{$bucket}.s3.{$region}.amazonaws.com/" . ltrim($this->avatar, '/');
        }
        return asset('images/default-avatar.png');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isEnrolledIn($courseId): bool
    {
        return $this->enrollments()
            ->where('course_id', $courseId)
            ->where('status', 'active')
            ->exists();
    }

    public function getEnrollmentProgress($courseId): float
    {
        $enrollment = $this->enrollments()
            ->where('course_id', $courseId)
            ->first();

        return $enrollment ? $enrollment->progress : 0;
    }

    public function hasCompletedCourse($courseId): bool
    {
        $enrollment = $this->enrollments()
            ->where('course_id', $courseId)
            ->first();

        return $enrollment && $enrollment->isCompleted();
    }

    public function hasCertificateFor($courseId): bool
    {
        return $this->certificates()
            ->where('course_id', $courseId)
            ->exists();
    }

    public function getTotalEnrollments(): int
    {
        return $this->enrollments()->count();
    }

    public function getCompletedEnrollments(): int
    {
        return $this->enrollments()
            ->where('status', 'completed')
            ->count();
    }

    public function getTotalCertificates(): int
    {
        return $this->certificates()->count();
    }

    public function getAverageProgress(): float
    {
        $enrollments = $this->enrollments;
        if ($enrollments->isEmpty()) {
            return 0;
        }

        return round($enrollments->avg('progress'), 2);
    }

    public function getEmergencyContact()
    {
        if ($this->parent1_is_emergency_contact) {
            return [
                'name' => $this->parent1_name,
                'relationship' => $this->parent1_relationship,
                'phone' => $this->parent1_phone,
                'email' => $this->parent1_email
            ];
        }

        if ($this->parent2_is_emergency_contact) {
            return [
                'name' => $this->parent2_name,
                'relationship' => $this->parent2_relationship,
                'phone' => $this->parent2_phone,
                'email' => $this->parent2_email
            ];
        }

        return null;
    }

    public function getFullParentInfo()
    {
        $parents = [];

        if ($this->parent1_name) {
            $parents[] = [
                'name' => $this->parent1_name,
                'relationship' => $this->parent1_relationship,
                'phone' => $this->parent1_phone,
                'email' => $this->parent1_email,
                'occupation' => $this->parent1_occupation,
                'is_emergency_contact' => $this->parent1_is_emergency_contact
            ];
        }

        if ($this->parent2_name) {
            $parents[] = [
                'name' => $this->parent2_name,
                'relationship' => $this->parent2_relationship,
                'phone' => $this->parent2_phone,
                'email' => $this->parent2_email,
                'occupation' => $this->parent2_occupation,
                'is_emergency_contact' => $this->parent2_is_emergency_contact
            ];
        }

        return $parents;
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'user_id', 'user_id');
    }

    // Tự động hash password khi set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Tự động thêm domain vào email nếu chưa có
    public function setEmailAttribute($value)
    {
        if (!str_ends_with($value, '@ay.learning.english')) {
            $value = $value . '@ay.learning.english';
        }
        $this->attributes['email'] = strtolower($value);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            if (!$student->student_code) {
                $student->student_code = static::generateStudentCode();
            }
        });
    }

    public static function generateStudentCode(): string
    {
        $prefix = 'STU';
        $year = date('y');

        $latestStudent = static::whereYear('created_at', date('Y'))
            ->latest('id')
            ->first();

        $sequence = $latestStudent ? (intval(substr($latestStudent->student_code, -3)) + 1) : 1;

        return $prefix . $year . str_pad($sequence, 3, '0', STR_PAD_LEFT);
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
            'user_type' => 'student',
            'student_code' => $this->student_code,
            'email' => $this->email
        ];
    }

    /**
     * Lấy danh sách đăng ký khóa học của học viên
     */
    public function courseRegistrations(): BelongsToMany
    {
        return $this->belongsToMany(CourseRegistration::class, 'course_registration_student')
                    ->withTimestamps();
    }

    /**
     * Check if student is locked
     */
    public function isLocked(): bool
    {
        if (!$this->login_lock || !$this->login_lock_expires_at) {
            return false;
        }

        return $this->login_lock_expires_at->isFuture();
    }

    /**
     * Check if student can login from device
     */
    public function canLoginFromDevice(string $deviceId): bool
    {
        if (!$this->device_id) {
            return true;
        }

        return $this->device_id === $deviceId;
    }

    /**
     * Lock student for login
     */
    public function lock(string $lockId, int $seconds = 10): void
    {
        $this->update([
            'login_lock' => $lockId,
            'login_lock_expires_at' => now()->addSeconds($seconds)
        ]);
    }

    /**
     * Unlock student
     */
    public function unlock(): void
    {
        $this->update([
            'login_lock' => null,
            'login_lock_expires_at' => null
        ]);
    }

    /**
     * Register device for student
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

    /**
     * Check if student is activated
     */
    public function isActivated(): bool
    {
        return $this->activated_at !== null;
    }

    /**
     * Activate student account
     */
    public function activate(): void
    {
        $this->update([
            'activation_token' => null,
            'activated_at' => now()
        ]);
    }
}
