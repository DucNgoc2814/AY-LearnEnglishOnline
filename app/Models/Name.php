<?php

namespace App\Models;

class Name extends BaseModel
{
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public static function getFields()
    {
        return [
            'name' => [
                'label' => 'Tên',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true
            ],
            'description' => [
                'label' => 'Mô tả',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false
            ],
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
