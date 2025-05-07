<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = ['product_id', 'warranty', 'origin', 'material', 'additional_info'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getFields()
    {
        return [
            'warranty' => [
                'label' => 'Bảo hành',
                'type' => 'text'
            ],
            'origin' => [
                'label' => 'Xuất xứ',
                'type' => 'text'
            ],
            'material' => [
                'label' => 'Chất liệu',
                'type' => 'text'
            ],
            'additional_info' => [
                'label' => 'Thông tin bổ sung',
                'type' => 'textarea'
            ]
        ];
    }
}
