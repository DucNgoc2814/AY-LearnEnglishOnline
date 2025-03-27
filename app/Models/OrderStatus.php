<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'order',
        'color_code'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    // Relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Methods
    public function getStatusWithColor(): array
    {
        return [
            'name' => $this->name,
            'color' => $this->color_code
        ];
    }

    public function canTransitionTo(OrderStatus $newStatus): bool
    {
        // Implement your status transition rules here
        // For example:
        $allowedTransitions = [
            'pending' => ['processing', 'cancelled'],
            'processing' => ['completed', 'cancelled'],
            'completed' => [],
            'cancelled' => []
        ];

        return in_array($newStatus->name, $allowedTransitions[$this->name] ?? []);
    }
} 