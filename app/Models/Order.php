<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'order_status_id',
        'transaction_id',
        'payment_amount',
        'price',
        'sale_percentage',
        'voucher_code',
        'payment_method',
        'payment_date',
        'note'
    ];

    protected $casts = [
        'payment_amount' => 'integer',
        'price' => 'integer',
        'sale_percentage' => 'integer',
        'payment_date' => 'datetime'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_code', 'code');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->whereHas('status', function($q) {
            $q->where('name', 'pending');
        });
    }

    public function scopeProcessing($query)
    {
        return $query->whereHas('status', function($q) {
            $q->where('name', 'processing');
        });
    }

    public function scopeCompleted($query)
    {
        return $query->whereHas('status', function($q) {
            $q->where('name', 'completed');
        });
    }

    public function scopeCancelled($query)
    {
        return $query->whereHas('status', function($q) {
            $q->where('name', 'cancelled');
        });
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'pending');
    }

    // Methods
    public function generateOrderNumber()
    {
        $prefix = 'ORD';
        $year = date('Y');
        $month = date('m');
        $random = strtoupper(substr(uniqid(), -6));
        
        $this->order_number = "{$prefix}-{$year}{$month}-{$random}";
        $this->save();
        
        return $this->order_number;
    }

    public function updateStatus($newStatus)
    {
        if ($this->status->canTransitionTo($newStatus)) {
            $this->order_status_id = $newStatus->id;
            $this->save();
            return true;
        }
        return false;
    }

    public function markAsPaid()
    {
        $this->payment_status = 'paid';
        $this->payment_date = now();
        $this->save();
    }

    public function markAsUnpaid()
    {
        $this->payment_status = 'pending';
        $this->payment_date = null;
        $this->save();
    }

    public function calculateTotal()
    {
        $this->amount = $this->items->sum('total_price');
        $this->save();
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->status->name === 'pending';
    }

    public function isProcessing(): bool
    {
        return $this->status->name === 'processing';
    }

    public function isCompleted(): bool
    {
        return $this->status->name === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status->name === 'cancelled';
    }
} 