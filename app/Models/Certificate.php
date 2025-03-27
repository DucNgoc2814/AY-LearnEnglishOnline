<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrollment_id',
        'certificate_number',
        'title',
        'issue_date',
        'expiry_date',
        'certificate_url',
        'meta_data',
        'is_verified',
        'verification_code'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'meta_data' => 'json',
        'is_verified' => 'boolean'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            // Tạo mã xác minh nếu chưa có
            if (empty($certificate->verification_code)) {
                $certificate->verification_code = Str::uuid();
            }
            
            // Tạo số chứng chỉ nếu chưa có
            if (empty($certificate->certificate_number)) {
                $certificate->certificate_number = self::generateCertificateNumber();
            }
        });
    }

    /**
     * Người dùng nhận chứng chỉ
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Khóa học của chứng chỉ
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Người cấp chứng chỉ
     */
    public function issuedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Kiểm tra xem chứng chỉ có còn hiệu lực không
     */
    public function isValid(): bool
    {
        return !$this->isExpired() && $this->status === 'active';
    }

    /**
     * Kiểm tra xem chứng chỉ có hết hạn chưa
     */
    public function isExpired(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isPast();
    }

    /**
     * Tạo số chứng chỉ
     */
    public static function generateCertificateNumber(): string
    {
        $prefix = 'CERT';
        $year = date('Y');
        $count = static::whereYear('created_at', $year)->count() + 1;
        
        return sprintf('%s-%s-%06d', $prefix, $year, $count);
    }

    /**
     * Xác minh chứng chỉ bằng mã xác minh
     */
    public function verify()
    {
        $this->is_verified = true;
        $this->save();
    }

    /**
     * Revoke/thu hồi chứng chỉ
     */
    public function revoke()
    {
        $this->status = 'revoked';
        $this->save();
    }

    /**
     * Scope lấy các chứng chỉ đã cấp
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope lấy các chứng chỉ đã thu hồi
     */
    public function scopeValid($query)
    {
        return $query->where('expiry_date', '>', now())
            ->orWhereNull('expiry_date');
    }

    /**
     * Ghi lại lượt tải chứng chỉ
     */
    public function recordDownload(): self
    {
        $this->download_count = ($this->download_count ?? 0) + 1;
        $this->last_downloaded_at = now();
        $this->save();
        
        return $this;
    }

    /**
     * Scope lấy các chứng chỉ đã hết hạn
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'issued')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now());
    }

    public function extend($months)
    {
        if ($this->expiry_date) {
            $this->expiry_date = $this->expiry_date->addMonths($months);
        } else {
            $this->expiry_date = now()->addMonths($months);
        }
        $this->save();
    }

    public function getGradeLabel(): string
    {
        switch ($this->grade) {
            case 'A':
                return 'Xuất sắc';
            case 'B':
                return 'Giỏi';
            case 'C':
                return 'Khá';
            case 'D':
                return 'Trung bình';
            default:
                return 'Không xếp loại';
        }
    }

    public function calculateGrade(): string
    {
        if ($this->score >= 90) {
            return 'A';
        } elseif ($this->score >= 80) {
            return 'B';
        } elseif ($this->score >= 70) {
            return 'C';
        } elseif ($this->score >= 60) {
            return 'D';
        } else {
            return 'F';
        }
    }

    public function issue(User $issuedBy)
    {
        $this->certificate_number = $this->generateCertificateNumber();
        $this->issue_date = now();
        $this->issued_by = $issuedBy->id;
        $this->status = 'active';
        $this->save();
    }

    public function getDownloadUrl(): string
    {
        return asset('storage/' . $this->file_path);
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }
} 