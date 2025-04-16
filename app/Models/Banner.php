<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image_url',
        'link_url',
        'order',
        'is_active',
        'start_date',
        'end_date',
        'position'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'order' => 'integer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'start_date',
        'end_date'
    ];

    /**
     * Scope a query to only include active banners.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    /**
     * Scope a query to order banners by their position and order.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('position')->orderBy('order');
    }

    /**
     * Scope a query to filter banners by position.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $position
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Get the banner's image URL with domain if it's a relative path.
     *
     * @param  string  $value
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return asset($value);
        }
        return $value;
    }

    /**
     * Check if the banner is currently active based on dates.
     *
     * @return bool
     */
    public function isCurrentlyActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->start_date && $this->start_date->gt($now)) {
            return false;
        }

        if ($this->end_date && $this->end_date->lt($now)) {
            return false;
        }

        return true;
    }
}
