<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image_url',
        'link_url',
        'is_active',
        'start_date',
        'end_date',
        'position',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'order' => 'integer'
    ];

    // Scope for active banners
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->orWhereNull('start_date')
                    ->orWhereNull('end_date');
            });
    }
}