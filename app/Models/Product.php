<?php

namespace App\Models;

class Product extends BaseModel
{
    public static function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048', // Max 2MB
            'is_active' => 'boolean'
        ];
    }

    public static function getFields()
    {
        return [
            'name' => [
                'label' => 'Tên sản phẩm',
                'type' => 'text'
            ],
            'price' => [
                'label' => 'Giá',
                'type' => 'number',
                'step' => '0.01'
            ],
            'category_id' => [
                'label' => 'Danh mục',
                'type' => 'select',
                'options' => Category::pluck('name', 'id')->toArray()
            ],
            'description' => [
                'label' => 'Mô tả',
                'type' => 'textarea'
            ],
            'image' => [
                'label' => 'Hình ảnh',
                'type' => 'file'
            ],
            'is_active' => [
                'label' => 'Kích hoạt',
                'type' => 'checkbox'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Format giá tiền
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.') . ' đ';
    }
}
