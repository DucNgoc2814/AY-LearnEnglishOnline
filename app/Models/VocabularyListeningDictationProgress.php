<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VocabularyListeningDictationProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vocabulary_listening_dictation_progress';

    protected $fillable = [
        'student_id',
        'dictation_id',
        'progress',
        'retries',
        'highest_score',
        'scores_history',
        'completed_blanks',
        'last_activity'
    ];

    protected $casts = [
        'progress' => 'decimal:2',
        'highest_score' => 'decimal:2',
        'scores_history' => 'array',
        'completed_blanks' => 'array',
        'last_activity' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function dictation()
    {
        return $this->belongsTo(VocabularyListeningDictation::class, 'dictation_id');
    }
}
