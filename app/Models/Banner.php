<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

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

    /**
     * Scope lấy banner theo vị trí
     */
    public function scopePosition($query, string $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Scope lấy banner đang trong thời gian hiển thị
     */
    public function scopeInPeriod($query)
    {
        $now = now();
        return $query->where(function($q) use ($now) {
            $q->whereNull('start_date')
                ->orWhere('start_date', '<=', $now);
        })->where(function($q) use ($now) {
            $q->whereNull('end_date')
                ->orWhere('end_date', '>=', $now);
        });
    }

    /**
     * Scope sắp xếp banner theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeByPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    // Methods
    public function isVisible(): bool
    {
        $now = now();
        
        if (!$this->is_active) {
            return false;
        }
        
        if ($this->start_date && $this->start_date > $now) {
            return false;
        }
        
        if ($this->end_date && $this->end_date < $now) {
            return false;
        }
        
        return true;
    }

    public function hasExpired(): bool
    {
        return $this->end_date && $this->end_date < now();
    }

    public function getImageUrl(): string
    {
        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }
        
        return asset('storage/' . $this->image_url);
    }

    public function getMobileImageUrl(): string
    {
        if (!$this->mobile_image) {
            return $this->getImageUrl();
        }
        
        if (filter_var($this->mobile_image, FILTER_VALIDATE_URL)) {
            return $this->mobile_image;
        }
        
        return asset('storage/' . $this->mobile_image);
    }
} 