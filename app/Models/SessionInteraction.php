<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionInteraction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'session_id',
        'user_id',
        'type',
        'content',
        'is_private',
        'is_highlighted',
        'is_answered'
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'is_highlighted' => 'boolean',
        'is_answered' => 'boolean'
    ];

    /**
     * Lấy buổi học của tương tác
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    /**
     * Lấy học viên tạo tương tác
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Lấy người dùng tạo tương tác
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope lấy tương tác theo loại
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope lấy tương tác theo học viên
     */
    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    /**
     * Lấy độ dài tương tác dưới dạng chuỗi
     */
    public function getFormattedDuration(): string
    {
        $minutes = $this->duration;
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $remainingMinutes);
        }

        return sprintf('%d phút', $minutes);
    }

    /**
     * Scope lấy tương tác câu hỏi
     */
    public function scopeQuestion($query)
    {
        return $query->where('type', 'question');
    }

    /**
     * Scope lấy tương tác câu trả lời
     */
    public function scopeAnswer($query)
    {
        return $query->where('type', 'answer');
    }

    /**
     * Scope lấy tương tác bình luận
     */
    public function scopeComment($query)
    {
        return $query->where('type', 'comment');
    }

    /**
     * Scope lấy tương tác bài kiểm tra
     */
    public function scopePoll($query)
    {
        return $query->where('type', 'poll');
    }
} 