<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_id',
        'user_id',
        'score',
        'status',
        'submitted_at',
        'feedback',
        'meta_data'
    ];

    protected $casts = [
        'score' => 'float',
        'submitted_at' => 'datetime',
        'meta_data' => 'json'
    ];

    /**
     * Lấy hoạt động của kết quả
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(SessionActivity::class, 'activity_id');
    }

    /**
     * Lấy học viên của kết quả
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grader(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'graded_by');
    }

    /**
     * Bắt đầu làm hoạt động
     */
    public function start()
    {
        $this->start_time = now();
        $this->status = 'in_progress';
        $this->save();
    }

    /**
     * Hoàn thành hoạt động
     */
    public function complete($points = null)
    {
        $this->end_time = now();
        $this->status = 'completed';
        if ($points !== null) {
            $this->points = $points;
        }
        $this->calculateDuration();
        $this->save();
    }

    public function calculateDuration()
    {
        if ($this->start_time && $this->end_time) {
            $this->duration = $this->end_time->diffInMinutes($this->start_time);
        }
    }

    /**
     * Format thời lượng làm bài theo định dạng phút:giây
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }

    /**
     * Lấy tỷ lệ phần trăm điểm đạt được
     */
    public function getScorePercentage(): float
    {
        if ($this->max_points === 0) {
            return 0;
        }
        return round(($this->points / $this->max_points) * 100, 2);
    }

    /**
     * Kiểm tra xem kết quả có phải là đã hoàn thành không
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Kiểm tra xem kết quả có đạt yêu cầu không
     */
    public function isPassed(): bool
    {
        $minPointsToPass = $this->activity->min_points_to_pass ?? 0;
        return $this->points >= $minPointsToPass;
    }

    /**
     * Kiểm tra xem kết quả có đang trong quá trình làm không
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->completed_at = now();
        $this->save();
        
        return $this;
    }

    public function grade($points, $feedback = null, $gradedBy = null)
    {
        $this->points = min($points, $this->max_points);
        $this->status = 'graded';
        
        if ($feedback) {
            $this->feedback = $feedback;
        }
        
        if ($gradedBy) {
            $this->graded_by = $gradedBy;
        }
        
        $this->graded_at = now();
        $this->save();
        
        return $this;
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeGraded($query)
    {
        return $query->where('status', 'graded');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
} 