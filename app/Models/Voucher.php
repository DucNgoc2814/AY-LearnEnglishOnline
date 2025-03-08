<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Voucher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'sale',
        'startDate',
        'endDate',
        'usageCount',
        'maxUsage',
        'minOrderValue',
        'maxDiscount'
    ];

    protected $casts = [
        'sale' => 'decimal:2',
        'startDate' => 'datetime',
        'endDate' => 'datetime',
        'usageCount' => 'integer',
        'maxUsage' => 'integer',
        'minOrderValue' => 'decimal:2',
        'maxDiscount' => 'decimal:2'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'voucherId');
    }

    public function isValid()
    {
        // Convert dates to timestamps for simple comparison
        $now = time();
        $startTimestamp = strtotime($this->startDate);
        $endTimestamp = strtotime($this->endDate);
        
        // Check if current time is within the valid date range
        // OR if the start date is in the future (not yet started)
        $isDateValid = ($now >= $startTimestamp && $now <= $endTimestamp) || ($startTimestamp > $now);
        
        // Check if usage count is within limits
        $isUsageValid = ($this->maxUsage === null || $this->usageCount < $this->maxUsage);
        
        return $isDateValid && $isUsageValid;
    }
} 