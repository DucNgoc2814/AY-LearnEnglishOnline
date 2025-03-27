<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrollment_date',
        'expiry_date',
        'status',
        'progress',
        'last_access_date',
        'completion_date',
        'notes'
    ];

    protected $casts = [
        'enrollment_date' => 'datetime',
        'expiry_date' => 'datetime',
        'last_access_date' => 'datetime',
        'completion_date' => 'datetime',
        'progress' => 'integer'
    ];

    /**
     * Lấy thông tin học viên
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy thông tin khóa học
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Lấy thông tin tiến độ học tập
     */
    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }

    /**
     * Kiểm tra trạng thái ghi danh
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Kiểm tra trạng thái hoàn thành
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Kiểm tra trạng thái hết hạn
     */
    public function isExpired(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isPast();
    }

    /**
     * Kiểm tra trạng thái hủy
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Cập nhật trạng thái ghi danh
     */
    public function updateStatus(string $status): self
    {
        $this->status = $status;
        
        if ($status === 'completed') {
            $this->completion_date = now();
            $this->progress = 100;
        }
        
        $this->save();
        return $this;
    }

    /**
     * Cập nhật tiến độ học tập
     */
    public function updateProgress()
    {
        $totalLessons = $this->course->lessons()->count();
        if ($totalLessons === 0) {
            return;
        }

        $completedLessons = $this->progress()
            ->where('status', 'completed')
            ->count();

        $this->progress = round(($completedLessons / $totalLessons) * 100, 2);
        $this->save();

        if ($this->progress >= 100) {
            $this->updateStatus('completed');
        }
    }

    /**
     * Đánh dấu là đã thanh toán
     */
    public function markAsPaid(string $paymentMethod, string $transactionId, float $amount): self
    {
        $this->payment_status = 'paid';
        $this->payment_method = $paymentMethod;
        $this->transaction_id = $transactionId;
        $this->paid_amount = $amount;
        $this->save();
        
        return $this;
    }

    /**
     * Scope lấy các ghi danh đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope lấy các ghi danh đã hoàn thành
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope lấy các ghi danh đã hết hạn
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    /**
     * Scope lấy các ghi danh đã được thanh toán
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope lấy các ghi danh chưa thanh toán
     */
    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    /**
     * Bắt đầu học
     */
    public function start()
    {
        $this->enrollment_date = now();
        $this->status = 'active';
        $this->save();
    }

    /**
     * Hoàn thành khóa học
     */
    public function complete()
    {
        $this->completion_date = now();
        $this->status = 'completed';
        $this->progress = 100;
        $this->save();
    }

    /**
     * Kiểm tra trạng thái có quyền truy cập
     */
    public function hasAccess(): bool
    {
        return $this->isActive() && !$this->isExpired();
    }

    /**
     * Gia hạn quyền truy cập
     */
    public function extend($days)
    {
        if ($this->expiry_date) {
            $this->expiry_date = $this->expiry_date->addDays($days);
        } else {
            $this->expiry_date = now()->addDays($days);
        }
        $this->save();
    }

    /**
     * Lấy thời gian đã học
     */
    public function getTimeSpent(): int
    {
        return $this->progress()->sum('time_spent');
    }

    /**
     * Lấy thời gian đã học dưới dạng chuỗi
     */
    public function getFormattedTimeSpent(): string
    {
        $minutes = $this->getTimeSpent();
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $remainingMinutes);
        }

        return sprintf('%d phút', $minutes);
    }

    /**
     * Lấy số ngày còn lại
     */
    public function getRemainingDays(): int
    {
        if (!$this->expiry_date) {
            return -1; // Unlimited access
        }
        return max(0, now()->diffInDays($this->expiry_date));
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
} 