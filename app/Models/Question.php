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
        'order_number'
    ];

    protected $casts = [
        'points' => 'float',
        'order' => 'integer',
        'is_required' => 'boolean',
        'meta_data' => 'array'
    ];

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
     * Kiểm tra câu hỏi có phải là dạng trắc nghiệm nhiều lựa chọn không
     */
    public function isMultipleChoice(): bool
    {
        return $this->question_type === 'multiple_choice';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng trắc nghiệm một lựa chọn không
     */
    public function isSingleChoice(): bool
    {
        return $this->question_type === 'single_choice';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng trả lời ngắn không
     */
    public function isShortAnswer(): bool
    {
        return $this->question_type === 'short_answer';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng trả lời dài không
     */
    public function isLongAnswer(): bool
    {
        return $this->question_type === 'long_answer';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng đúng/sai không
     */
    public function isTrueFalse(): bool
    {
        return $this->question_type === 'true_false';
    }

    /**
     * Kiểm tra câu hỏi có phải là dạng ghép đôi không
     */
    public function isMatching(): bool
    {
        return $this->question_type === 'matching';
    }

    /**
     * Lấy câu trả lời đúng
     */
    public function getCorrectOption()
    {
        if ($this->question_type === 'single_choice' || $this->question_type === 'multiple_choice') {
            return $this->options()->where('is_correct', true)->first();
        }

        return null;
    }

    /**
     * Lấy tất cả các câu trả lời đúng (trường hợp nhiều đáp án đúng)
     */
    public function getCorrectOptions()
    {
        if ($this->question_type === 'multiple_choice') {
            return $this->options()->where('is_correct', true)->get();
        }

        return collect();
    }

    /**
     * Kiểm tra đáp án
     */
    public function checkAnswer($answer): bool
    {
        switch ($this->question_type) {
            case 'multiple_choice':
                return $this->checkMultipleChoiceAnswer($answer);
            case 'true_false':
                return $this->checkTrueFalseAnswer($answer);
            case 'multiple_answers':
                return $this->checkMultipleAnswersAnswer($answer);
            case 'short_answer':
                return $this->checkShortAnswer($answer);
            default:
                return false;
        }
    }

    protected function checkMultipleChoiceAnswer($answer): bool
    {
        return $answer === $this->correct_answer[0];
    }

    protected function checkTrueFalseAnswer($answer): bool
    {
        return $answer === $this->correct_answer[0];
    }

    protected function checkMultipleAnswersAnswer($answers): bool
    {
        if (!is_array($answers)) {
            return false;
        }

        sort($answers);
        $correctAnswers = $this->correct_answer;
        sort($correctAnswers);

        return $answers == $correctAnswers;
    }

    protected function checkShortAnswer($answer): bool
    {
        return strtolower(trim($answer)) === strtolower(trim($this->correct_answer[0]));
    }

    /**
     * Scope lấy các câu hỏi theo loại
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('question_type', $type);
    }

    /**
     * Scope lấy các câu hỏi theo độ khó
     */
    public function scopeOfDifficulty($query, $level)
    {
        return $query->where('difficulty_level', $level);
    }

    /**
     * Scope lấy các câu hỏi đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope lấy các câu hỏi theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
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
        $options = $this->options;
        shuffle($options);
        return $options;
    }

    public function getCorrectAnswers()
    {
        return $this->answers()->where('is_correct', true)->get();
    }

    public function isTextAnswer(): bool
    {
        return $this->question_type === 'text';
    }

    public function isEssayAnswer(): bool
    {
        return $this->question_type === 'essay';
    }

    public function requiresManualGrading(): bool
    {
        return in_array($this->question_type, ['essay', 'file_upload']);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('question_type', $type);
    }

    public function resultDetails()
    {
        return $this->hasMany(TestResultDetail::class);
    }
} 