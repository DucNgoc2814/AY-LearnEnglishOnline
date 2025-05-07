<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = ['product_id', 'name', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getFields()
    {
        return [
            'name' => [
                'label' => 'Tên thông số',
                'type' => 'text'
            ],
            'value' => [
                'label' => 'Giá trị',
                'type' => 'text'
            ]
        ];
    }
}
