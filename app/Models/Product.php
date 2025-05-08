<?php

namespace App\Models;

class Product extends BaseModel
{
    /**
     * Define media fields for the model
     */
    public static function mediaFields(): array
    {
        return [
            'image' => [
                'type' => 'image',
                'max_size' => 2048, // 2MB
                'mimes' => 'jpeg,png,jpg,gif',
                'label' => 'Hình ảnh sản phẩm'
            ],
            'video' => [
                'type' => 'video',
                'max_size' => 20480, // 20MB
                'mimes' => 'mp4,mov,avi',
                'label' => 'Video sản phẩm'
            ],
            'audio' => [
                'type' => 'audio',
                'max_size' => 10240, // 10MB
                'mimes' => 'mp3,wav',
                'label' => 'Audio sản phẩm'
            ]
        ];
    }

    /**
     * Get base validation rules
     */
    public static function getBaseRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean'
        ];
    }

    public static function getFields()
    {
        $fields = [
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
            'is_active' => [
                'label' => 'Kích hoạt',
                'type' => 'checkbox'
            ]
        ];

        // Thêm các trường media vào fields
        foreach (static::mediaFields() as $field => $config) {
            $fields[$field] = [
                'label' => $config['label'],
                'type' => 'file'
            ];
        }

        return $fields;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với bảng thông số kỹ thuật
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }

    // Quan hệ với thông tin chi tiết sản phẩm
    public function detail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    // Format giá tiền
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.') . ' đ';
    }
}
