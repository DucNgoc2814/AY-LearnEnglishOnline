<?php

namespace App\Models;

class Product extends BaseModel
{
    public static function getMediaConfig(): array
    {
        return [
            'image' => [
                'max_size' => 2048, // 2MB
                'mimes' => 'jpeg,png,jpg,gif',
            ],
            'video' => [
                'max_size' => 10240, // 10MB
                'mimes' => 'mp4,mov,avi',
            ],
            'audio' => [
                'max_size' => 5120, // 5MB
                'mimes' => 'mp3,wav',
            ]
        ];
    }

    public static function rules($id = null)
    {
        return array_merge([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean'
        ], static::getMediaValidationRules());
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

        // Add media fields
        foreach (static::getSupportedMediaTypes() as $type) {
            $fields[$type] = [
                'label' => ucfirst($type),
                'type' => $type === 'image' ? 'image' : 'file',
                'media_type' => $type
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

    // Get media URLs
    public function getImageUrlAttribute()
    {
        return $this->getMediaUrl('image');
    }

    public function getVideoUrlAttribute()
    {
        return $this->getMediaUrl('video');
    }

    public function getAudioUrlAttribute()
    {
        return $this->getMediaUrl('audio');
    }
}
