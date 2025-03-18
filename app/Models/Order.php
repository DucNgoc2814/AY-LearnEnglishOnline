<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'userId',
        'courseId',
        'amount',
        'paymentMethod',
        'status',
        'transactionCode',
        'paymentDate',
        'voucherId',
        'discountAmount'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discountAmount' => 'decimal:2',
        'paymentDate' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucherId');
    }

    public function orderStatuses()
    {
        return $this->hasMany(OrderStatus::class, 'orderId');
    }

} 