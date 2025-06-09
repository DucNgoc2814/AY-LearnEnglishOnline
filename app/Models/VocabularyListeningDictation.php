<?php

namespace App\Models;

use App\Traits\HasCommaSeparatedJsonFields;

class VocabularyListeningDictation extends BaseModel
{
    use HasCommaSeparatedJsonFields;

    protected $casts = [
        'blank_words' => 'array',
        'max_retries' => 'integer',
        'min_required_score' => 'decimal:2'
    ];

    protected function getCommaSeparatedJsonFields(): array
    {
        return [
            'blank_words' => [
                'structure' => [
                    'id' => fn($word, $index) => $index + 1,
                    'word' => fn($word) => $word,
                    'position' => fn($word, $index) => $index + 1
                ]
            ]
        ];
    }

    public static function mediaFields(): array
    {
        return [
            'audio_url' => [
                'type' => 'audio',
                'max_size' => 102400,
                'mimes' => 'mp3,wav,ogg',
                'label' => 'Audio'
            ],
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'audio_url' => 'required|string|max:255',
            'correct_text' => 'required|string',
            'display_text' => 'required|string',
            'blank_words' => 'required|string',
            'max_retries' => 'required|integer|min:1',
            'min_required_score' => 'required|numeric|min:0|max:100',
        ];
    }

    public static function getFields()
    {
        $fields = [
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'options' => Lesson::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'title' => [
                'label' => 'Tiêu đề',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'audio_url' => [
                'label' => 'Audio',
                'type' => 'file',
                'accept' => 'audio/*',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'correct_text' => [
                'label' => 'Văn bản đúng',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'display_text' => [
                'label' => 'Văn bản hiển thị',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'blank_words' => [
                'label' => 'Từ cần điền',
                'type' => 'tags',
                'searchable' => false,
                'sortable' => false,
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

        return $fields;
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

    public function setBlankWordsAttribute($value)
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
            $this->attributes['blank_words'] = json_encode($items);
        } else {
            $this->attributes['blank_words'] = is_array($value) ? json_encode($value) : '[]';
        }
    }

    public function getBlankWordsAttribute($value)
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
