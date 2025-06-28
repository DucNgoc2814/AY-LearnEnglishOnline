<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VocabularyListeningKeyPhraseProgress extends Model
{
    use SoftDeletes;

    protected $table = 'vocabulary_listening_key_phrase_progress';

    protected $fillable = [
        'student_id',
        'key_phrase_id',
        'progress',
        'retries',
        'highest_score',
        'scores_history',
        'completed_items',
        'current_position',
        'last_attempt'
    ];

    protected $casts = [
        'progress' => 'decimal:2',
        'highest_score' => 'decimal:2',
        'scores_history' => 'array',
        'completed_items' => 'array',
        'last_attempt' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function keyPhrase()
    {
        return $this->belongsTo(VocabularyListeningKeyPhrase::class, 'key_phrase_id');
    }
}
