<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'audio_url',
        'content'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];
    /**
     * Get all active dictations ordered by order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Get dictations by level.
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }
}
