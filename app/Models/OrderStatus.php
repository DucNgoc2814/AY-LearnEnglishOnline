<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
    ];

    // Nếu bạn muốn định nghĩa mối quan hệ với bảng orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'orderStatusId');
    }
}
