<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'orderable_type',
        'orderable_id',
        'name',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'meta_data'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'meta_data' => 'array'
    ];

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }

    // Methods
    public function calculateTotal()
    {
        $this->total_price = $this->quantity * $this->unit_price;
        $this->save();

        // Update order total
        $this->order->calculateTotal();
    }

    public function updateQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->calculateTotal();
    }

    public function updateUnitPrice($price)
    {
        $this->unit_price = $price;
        $this->calculateTotal();
    }
} 