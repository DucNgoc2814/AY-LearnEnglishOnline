<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends BaseModel
{
    public static function mediaFields(): array
    {
        $questionType = request()->input('type', 'text');

        // Return empty array for text type
        if ($questionType === 'text') {
            return [];
        }

        $config = [
            'media_url' => [
                'type' => match($questionType) {
                    'image' => 'image',
                    'video' => 'video',
                    'audio' => 'audio',
                    default => 'file'
                },
                'max_size' => match($questionType) {
                    'image' => 2048, // 2MB for images
                    'video' => 102400, // 100MB for videos
                    'audio' => 51200, // 50MB for audio
                    default => 2048
                },
                'mimes' => match($questionType) {
                    'image' => 'jpeg,png,jpg,gif',
                    'video' => 'mp4,webm,ogg',
                    'audio' => 'mp3,wav,ogg',
                    default => 'jpeg,png,jpg,gif'
                },
                'label' => 'Tệp đính kèm'
            ]
        ];

        return $config;
    }

    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }

    public static function getBaseRules($id = null)
    {
        return [
            'test_id' => 'required|exists:tests,id',
            'type' => 'required|in:text,image,video,audio',
            'role' => 'required|in:1,2',
            'question' => 'required|string',
            'media_url' => [
                'nullable',
                'required_if:type,image,video,audio',
                function ($attribute, $value, $fail) use ($id) {
                    $question = $id ? self::find($id) : null;
                    $type = request()->input('type', $question ? $question->type : null);

                    if ($type && in_array($type, ['image', 'video', 'audio']) && empty($value)) {
                        $fail('The media file is required for ' . $type . ' questions.');
                    }
                }
            ],
            'correct_answer_explanation' => 'nullable|string',
            'order_number' => 'required|integer|min:0',
        ];
    }

    public static function getFields()
    {
        $fields = [
            'test_id' => [
                'label' => 'Bài kiểm tra',
                'type' => 'select',
                'options' => Test::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
            ],
            'type' => [
                'label' => 'Loại câu hỏi',
                'type' => 'select',
                'options' => [
                    'text' => 'Câu hỏi văn bản',
                    'image' => 'Câu hỏi hình ảnh',
                    'video' => 'Câu hỏi video',
                    'audio' => 'Câu hỏi âm thanh'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
            ],
            'role' => [
                'label' => 'Hình thức',
                'type' => 'select',
                'options' => [
                    1 => 'Trắc nghiệm',
                    2 => 'Tự luận'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'default' => 1
            ],
            'question' => [
                'label' => 'Nội dung câu hỏi',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
            ],
            'media_url' => [
                'label' => 'Tệp đính kèm',
                'type' => 'file',
                'editable' => true,
                'depends_on' => [
                    'field' => 'type',
                    'values' => ['image', 'video', 'audio'],
                    'show_if_in' => true
                ],
                'file_types' => [
                    'image' => [
                        'accept' => 'image/*',
                        'max_size' => 2048, // 2MB
                        'mimes' => 'jpeg,png,jpg,gif'
                    ],
                    'video' => [
                        'accept' => 'video/*',
                        'max_size' => 102400, // 100MB
                        'mimes' => 'mp4,webm,ogg'
                    ],
                    'audio' => [
                        'accept' => 'audio/*',
                        'max_size' => 51200, // 50MB
                        'mimes' => 'mp3,wav,ogg'
                    ]
                ]
            ],
            'correct_answer_explanation' => [
                'label' => 'Giải thích đáp án đúng',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'order_number' => [
                'label' => 'Thứ tự',
                'type' => 'number',
                'min' => 0,
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'default' => 0
            ]
        ];

        // Chỉ thêm các trường media nếu không phải type text
        $currentType = request()->input('type', 'text');
        if ($currentType !== 'text') {
            foreach (static::mediaFields() as $field => $config) {
                $fields[$field] = [
                    'label' => $config['label'],
                    'type' => 'file',
                    'accept' => $config['type'] === 'image' ? 'image/*' : 'video/*',
                    'max_size' => $config['max_size'],
                    'editable' => true
                ];
            }
        }

        return $fields;
    }

    /**
     * Get fields for form (create/edit)
     */
    public static function getFormFields()
    {
        $fields = [];
        foreach (self::getFields() as $key => $field) {
            if (!isset($field['editable']) || $field['editable']) {
                $fields[$key] = $field;
            }
        }
        return $fields;
    }

    /**
     * Get fields for listing
     */
    public static function getListFields()
    {
        return self::getFields();
    }

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


    public function resultDetails()
    {
        return $this->hasMany(TestResultDetail::class);
    }
}
