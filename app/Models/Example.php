<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App\Models
 * @author Your Name
 * @description Model quản lý Example
 */
class Example extends Model
{
    use SoftDeletes;

    /**
     * Các trường có thể gán giá trị
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'status',
        'image',
        'published_at'
    ];

    /**
     * Định nghĩa kiểu dữ liệu cho các trường
     */
    protected $casts = [
        'price' => 'float',
        'status' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Tên bảng trong database
     */
    protected $table = 'examples';
} 