<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'class_student';

    protected $fillable = [
        'class_id',
        'student_id',
        'status',
        'fee_amount',
        'payment_status',
        'payment_method',
        'payment_date',
        'invoice_number',
        'enrollment_date',
        'completion_date',
        'notes'
    ];

    protected $casts = [
        'fee_amount' => 'decimal:2',
        'payment_date' => 'date',
        'enrollment_date' => 'date',
        'completion_date' => 'date'
    ];

    // Relationships
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeDropped($query)
    {
        return $query->where('status', 'dropped');
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
    public function markAsActive()
    {
        $this->status = 'active';
        $this->save();
    }

    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->completion_date = now();
        $this->save();
    }

    public function markAsDropped($reason = null)
    {
        $this->status = 'dropped';
        if ($reason) {
            $this->notes = $reason;
        }
        $this->save();
    }

    public function recordPayment($method, $amount = null)
    {
        $this->payment_status = 'paid';
        $this->payment_method = $method;
        $this->payment_date = now();
        if ($amount) {
            $this->fee_amount = $amount;
        }
        $this->save();
    }

    public function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $year = date('Y');
        $month = date('m');
        $random = strtoupper(substr(uniqid(), -4));
        
        $this->invoice_number = "{$prefix}{$year}{$month}-{$random}";
        $this->save();
        
        return $this->invoice_number;
    }
} 