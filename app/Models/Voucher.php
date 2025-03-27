<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'sale',
        'start_date',
        'end_date',
        'usage_count',
        'max_usage',
        'min_order_value',
        'max_discount'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'usage_count' => 'integer',
        'max_usage' => 'integer',
        'min_order_value' => 'integer',
        'max_discount' => 'integer'
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'voucher_code', 'code');
    }

    // Check if voucher is valid
    public function isValid(): bool
    {
        return $this->start_date <= now() &&
            $this->end_date >= now() &&
            ($this->max_usage === null || $this->usage_count < $this->max_usage);
    }
} 