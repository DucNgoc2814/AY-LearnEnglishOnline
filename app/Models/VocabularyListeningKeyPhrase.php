<?php

namespace App\Models;
use App\Traits\HasCommaSeparatedJsonFields;

class VocabularyListeningKeyPhrase extends BaseModel
{
    use HasCommaSeparatedJsonFields;

    protected $casts = [
        'highlighted_words' => 'array',
        'correct_answer' => 'array',
        'max_retries' => 'integer',
        'min_required_score' => 'decimal:2'
    ];
    protected function getCommaSeparatedJsonFields(): array
    {
        return [
            'highlighted_words' => [
                'structure' => [
                    'id' => fn($word, $index) => $index + 1,
                    'word' => fn($word) => $word,
                    'position' => fn($word, $index) => $index + 1
                ]
            ],
            'correct_answer' => [
                'structure' => [
                    'id' => fn($word, $index) => $index + 1,
                    'word' => fn($word) => $word,
                    'position' => fn($word, $index) => $index + 1
                ]
            ]
        ];
    }

    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'english_phrase' => 'required|string|max:255',
            'vietnamese_phrase' => 'required|string|max:255',
            'highlighted_words' => 'required|string',
            'incomplete_phrase' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:255',
            'max_retries' => 'required|integer|min:1',
            'min_required_score' => 'required|numeric|min:0|max:100',
        ];
    }

    public static function getFields()
    {
        return [
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'options' => Lesson::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'english_phrase' => [
                'label' => 'Cụm từ tiếng Anh',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'vietnamese_phrase' => [
                'label' => 'Nghĩa tiếng Việt',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'highlighted_words' => [
                'label' => 'Các từ tiếng Việt cần highlight',
                'type' => 'tags',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'incomplete_phrase' => [
                'label' => 'Cụm từ có chỗ trống',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'correct_answer' => [
                'label' => 'Đáp án đúng',
                'type' => 'tags',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'max_retries' => [
                'label' => 'Số lần làm lại tối đa',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'min_required_score' => [
                'label' => 'Điểm tối thiểu (%)',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
        ];
    }

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

    public static function getListFields()
    {
        return self::getFields();
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function setHighlightedWordsAttribute($value)
    {
        if (is_string($value)) {
            $words = array_map('trim', explode(',', $value));
            $words = array_filter($words);

            $items = [];
            foreach ($words as $index => $word) {
                if (!empty($word)) {
                    $items[] = [
                        'id' => $index + 1,
                        'word' => $word,
                        'position' => $index + 1
                    ];
                }
            }
            $this->attributes['highlighted_words'] = json_encode($items);
        } else {
            $this->attributes['highlighted_words'] = is_array($value) ? json_encode($value) : '[]';
        }
    }

    public function getHighlightedWordsAttribute($value)
    {
        if (request()->is('*/api/*')) {
            return json_decode($value, true) ?? [];
        }

        $items = json_decode($value, true) ?? [];
        return implode(', ', array_column($items, 'word'));
    }
    public function setCorrectAnswerAttribute($value)
    {
        if (is_string($value)) {
            $words = array_map('trim', explode(',', $value));
            $words = array_filter($words);

            $items = [];
            foreach ($words as $index => $word) {
                if (!empty($word)) {
                    $items[] = [
                        'id' => $index + 1,
                        'word' => $word,
                        'position' => $index + 1
                    ];
                }
            }
            $this->attributes['correct_answer'] = json_encode($items);
        } else {
            $this->attributes['correct_answer'] = is_array($value) ? json_encode($value) : '[]';
        }
    }

    public function getCorrectAnswerAttribute($value)
    {
        if (request()->is('*/api/*')) {
            return json_decode($value, true) ?? [];
        }

        $items = json_decode($value, true) ?? [];
        return implode(', ', array_column($items, 'word'));
    }

    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }
}
