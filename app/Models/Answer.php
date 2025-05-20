<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends BaseModel
{

    public static function mediaFields(): array
    {
        return [
            'url' => [
                'type' => 'image',
                'max_size' => 2048, // 2MB
                'mimes' => 'jpeg,png,jpg,gif',
                'label' => 'Hình ảnh khóa học'
            ],
        ];
    }
    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
        'type',
        'url',
        'order_number'
    ];

    public static function getBaseRules($id = null)
    {
        return [
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'is_correct' => 'boolean',
            'type' => 'required|in:single,multiple',
            'url' => 'nullable|string',
            'order_number' => 'required|integer|min:0'
        ];
    }

    public static function getFields()
    {
        return [
            'answer' => [
                'label' => 'Câu trả lời',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
            ],
            'is_correct' => [
                'label' => 'Đáp án đúng',
                'type' => function($model) {
                    // Nếu câu hỏi là trắc nghiệm một đáp án
                    if ($model && $model->question && $model->question->role == 1 && $model->type == 'single') {
                        return 'radio';
                    }
                    // Nếu câu hỏi là trắc nghiệm nhiều đáp án
                    return 'checkbox';
                },
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'group_name' => 'correct_answers', // Dùng cho radio buttons để nhóm chung
                'depends_on' => [
                    'field' => 'type',
                    'values' => ['single', 'multiple']
                ]
            ],
            'type' => [
                'label' => 'Loại đáp án',
                'type' => 'select',
                'options' => [
                    'single' => 'Đáp án đơn',
                    'multiple' => 'Đáp án đa chọn'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'required' => true,
                'default' => 'single',
                'depends_on' => [
                    'field' => 'question.role',
                    'values' => [1], // Chỉ hiển thị khi là câu hỏi trắc nghiệm
                    'show_if_in' => true
                ]
            ],
            'url' => [
                'label' => 'Hình ảnh đáp án',
                'type' => 'file',
                'accept' => 'image/*',
                'max_size' => 2048, // 2MB
                'mimes' => 'jpeg,png,jpg,gif',
                'searchable' => false,
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
                'required' => true,
                'default' => 0
            ]
        ];
    }
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
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
    // Relationships
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function resultDetails()
    {
        return $this->hasMany(TestResultDetail::class);
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_number');
    }

    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }
}
