<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LearningLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'loggable_type',
        'loggable_id',
        'action',
        'device_type',
        'ip_address',
        'duration_seconds',
        'action_time',
        'meta_data'
    ];

    protected $casts = [
        'action_time' => 'datetime',
        'duration_seconds' => 'integer',
        'meta_data' => 'json'
    ];

    /**
     * Người dùng đã tạo log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Đối tượng liên quan đến log
     */
    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }
} 