<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VocabularyListeningGrammarProgress extends Model
{
    use SoftDeletes;

    protected $table = 'vocabulary_listening_grammar_progress';

    protected $fillable = [
        'student_id',
        'grammar_id',
        'progress',
        'retries',
        'highest_score',
        'completed_items',
        'scores_history',
        'current_position',
        'last_attempt',
        'min_score_achieved'
    ];

    protected $casts = [
        'progress' => 'decimal:2',
        'highest_score' => 'decimal:2',
        'completed_items' => 'array',
        'scores_history' => 'array',
        'min_score_achieved' => 'boolean',
        'last_attempt' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function grammar()
    {
        return $this->belongsTo(VocabularyListeningGrammar::class);
    }
}
