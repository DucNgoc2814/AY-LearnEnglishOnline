<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'test_id',
        'type',
        'question',
        'media_url',
        'role',
        'correct_answer_explanation',
        'order_number'
    ];

    protected $casts = [
        'order_number' => 'integer'
    ];

    protected $appends = ['full_media_url'];

    public function questionable()
    {
        return $this->morphTo();
    }

    /**
     * Bài kiểm tra của câu hỏi
     */
    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Các kết quả trả lời của học viên
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng Text không
     */
    public function isText(): bool
    {
        return $this->type === 'text';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng Image không
     */
    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng Video không
     */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng Audio không
     */
    public function isAudio(): bool
    {
        return $this->type === 'audio';
    }

    /**
     * Lấy câu trả lời đúng
     */
    public function getCorrectOption()
    {
        return $this->answers()->where('is_correct', true)->first();
    }

    /**
     * Lấy tất cả các câu trả lời đúng (trường hợp nhiều đáp án đúng)
     */
    public function getCorrectOptions()
    {
        return $this->answers()->where('is_correct', true)->get();
    }

    /**
     * Kiểm tra đáp án
     */
    public function checkAnswer($answer): bool
    {
        $correctAnswer = $this->getCorrectOption();

        if (!$correctAnswer) {
            return false;
        }

        return $answer === $correctAnswer->answer;
    }

    /**
     * Scope lấy các câu hỏi theo loại
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope lấy các câu hỏi theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_number');
    }

    public function getAnswersByAttempt($attemptId)
    {
        return $this->answers()
            ->where('attempt_id', $attemptId)
            ->get();
    }

    public function getStudentAnswer($studentId)
    {
        return $this->answers()
            ->whereHas('attempt', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->latest()
            ->first();
    }

    public function isAnsweredCorrectly($studentId): bool
    {
        $answer = $this->getStudentAnswer($studentId);
        return $answer && $answer->is_correct;
    }

    public function getCorrectAnswerRate(): float
    {
        $totalAnswers = $this->answers()->count();
        if ($totalAnswers === 0) {
            return 0;
        }

        $correctAnswers = $this->answers()
            ->where('is_correct', true)
            ->count();

        return round(($correctAnswers / $totalAnswers) * 100, 2);
    }

    public function getDifficultyLevel(): string
    {
        $correctRate = $this->getCorrectAnswerRate();

        if ($correctRate >= 80) {
            return 'Dễ';
        } elseif ($correctRate >= 40) {
            return 'Trung bình';
        } else {
            return 'Khó';
        }
    }

    public function shuffleOptions(): array
    {
        $options = $this->answers;
        $shuffled = $options->shuffle();
        return $shuffled->values()->all();
    }

    public function getCorrectAnswers()
    {
        return $this->answers()->where('is_correct', true)->get();
    }

    public function resultDetails()
    {
        return $this->hasMany(TestResultDetail::class);
    }

    public function getFullMediaUrlAttribute()
    {
        if (empty($this->media_url)) {
            return null;
        }

        // Nếu đã là URL đầy đủ, trả về luôn
        if (filter_var($this->media_url, FILTER_VALIDATE_URL)) {
            return $this->media_url;
        }

        // Xây dựng URL đầy đủ từ cấu hình
        $diskConfig = config('filesystems.disks.s3');
        $cloudFrontDomain = config('filesystems.disks.cloudfront.domain', null);

        if ($cloudFrontDomain) {
            return "https://{$cloudFrontDomain}/{$this->media_url}";
        }

        return "{$diskConfig['url']}/{$this->media_url}";
    }
}
