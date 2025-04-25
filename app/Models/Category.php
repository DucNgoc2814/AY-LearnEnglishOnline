<?php

namespace App\Models;

class Category extends BaseModel
{
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }

    public static function getFields()
    {
        return [
            'name' => [
                'label' => 'Tên danh mục',
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
            'parent_id' => [
                'label' => 'Danh mục cha',
                'type' => 'select',
                'options' => self::pluck('name', 'id')->toArray(),
                'filterable' => true,
                'filter_options' => self::pluck('name', 'id')->toArray(),
                'sortable' => true
            ]
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
