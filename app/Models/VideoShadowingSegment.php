<?php

namespace App\Models;

class VideoShadowingSegment extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'video_shadowing_id' => 'required|exists:video_shadowings,id',
            'start_time' => 'required|integer|min:0',
            'end_time' => 'required|integer|min:0|gt:start_time',
            'english_text' => 'required|string',
            'vietnamese_text' => 'required|string',
            'order_index' => 'required|integer|min:0',
        ];
    }

    public static function getFields()
    {
        return [
            'video_shadowing_id' => [
                'label' => 'Video Shadowing',
                'type' => 'select',
                'options' => VideoShadowing::pluck('title', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'start_time' => [
                'label' => 'Thời gian bắt đầu (giây)',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'end_time' => [
                'label' => 'Thời gian kết thúc (giây)',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'english_text' => [
                'label' => 'Văn bản tiếng Anh',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'vietnamese_text' => [
                'label' => 'Văn bản tiếng Việt',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'order_index' => [
                'label' => 'Thứ tự',
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

    public function videoShadowing()
    {
        return $this->belongsTo(VideoShadowing::class);
    }
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }

}
