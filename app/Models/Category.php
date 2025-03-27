<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'order',
        'is_active',
        'icon',
        'thumbnail'
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Lấy danh sách khóa học thuộc danh mục
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Lấy số lượng khóa học thuộc danh mục
     */
    public function getCourseCountAttribute(): int
    {
        return $this->courses()->count();
    }

    /**
     * Lấy số lượng khóa học đang hoạt động thuộc danh mục
     */
    public function getActiveCourseCountAttribute(): int
    {
        return $this->courses()->where('is_active', true)->count();
    }

    /**
     * Lấy slug từ tên danh mục
     */
    public function getSlugFromName(): string
    {
        return Str::slug($this->name);
    }

    /**
     * Boot model và tự động tạo slug nếu không có
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
} 