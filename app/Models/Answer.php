<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
        'type',
        'url',
        'order_number'
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'type' => 'string'
    ];

    // Relationships
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function resultDetails()
    {
        return $this->hasMany(TestResultDetail::class);
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_number');
    }

    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }
}
