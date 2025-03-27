<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SessionActivity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'session_id',
        'title',
        'description',
        'type',
        'content',
        'start_time',
        'end_time',
        'duration_minutes',
        'is_graded',
        'is_mandatory'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'duration_minutes' => 'integer',
        'is_graded' => 'boolean',
        'is_mandatory' => 'boolean'
    ];

    /**
     * Lấy buổi học của hoạt động
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    /**
     * Lấy danh sách kết quả hoạt động
     */
    public function results(): HasMany
    {
        return $this->hasMany(ActivityResult::class);
    }

    /**
     * Lấy các tài liệu liên quan đến hoạt động
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    /**
     * Lấy tỷ lệ đạt yêu cầu
     */
    public function getPassingRateAttribute(): float
    {
        $totalResults = $this->results()->count();
        
        if ($totalResults === 0) {
            return 0;
        }
        
        $passedResults = $this->results()
            ->where('points', '>=', $this->min_points_to_pass)
            ->count();
        
        return ($passedResults / $totalResults) * 100;
    }

    /**
     * Lấy điểm trung bình
     */
    public function getAveragePointsAttribute(): float
    {
        $results = $this->results();
        
        if ($results->count() === 0) {
            return 0;
        }
        
        return $results->average('points');
    }

    /**
     * Kiểm tra xem hoạt động đã bắt đầu chưa
     */
    public function isStarted(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Kiểm tra xem hoạt động đã kết thúc chưa
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Kiểm tra xem hoạt động đã bị hủy chưa
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Bắt đầu hoạt động
     */
    public function start(): self
    {
        $this->status = 'in_progress';
        $this->start_time = now();
        $this->save();
        
        return $this;
    }

    /**
     * Kết thúc hoạt động
     */
    public function complete(): self
    {
        $this->status = 'completed';
        $this->end_time = now();
        
        if ($this->start_time) {
            $this->duration = $this->start_time->diffInMinutes($this->end_time);
        }
        
        $this->save();
        
        return $this;
    }

    /**
     * Hủy hoạt động
     */
    public function cancel(): self
    {
        $this->status = 'cancelled';
        $this->save();
        
        return $this;
    }

    /**
     * Kiểm tra xem học viên đã hoàn thành hoạt động chưa
     */
    public function isCompletedByStudent(int $studentId): bool
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->where('status', 'completed')
            ->exists();
    }

    /**
     * Kiểm tra xem học viên đã vượt qua hoạt động chưa
     */
    public function isPassedByStudent(int $studentId): bool
    {
        $result = $this->results()
            ->where('student_id', $studentId)
            ->first();
        
        return $result && $result->points >= $this->min_points_to_pass;
    }

    /**
     * Lấy kết quả của học viên cho hoạt động này
     */
    public function getStudentResult(int $studentId): ?ActivityResult
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->first();
    }

    /**
     * Scope lấy các hoạt động đang diễn ra
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope lấy các hoạt động đã hoàn thành
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope lấy các hoạt động đã lên lịch
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * Scope lấy các hoạt động yêu cầu
     */
    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    /**
     * Scope lấy các hoạt động có tính điểm
     */
    public function scopeGraded($query)
    {
        return $query->where('is_graded', true);
    }

    /**
     * Scope lấy các hoạt động theo loại
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('activity_type', $type);
    }

    public function calculateDuration()
    {
        if ($this->start_time && $this->end_time) {
            $this->duration = $this->end_time->diffInSeconds($this->start_time);
            $this->save();
        }
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
} 