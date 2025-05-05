<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Example extends Model
{
    protected $fillable = [
        'text',
        'word_id'
    ];

    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
