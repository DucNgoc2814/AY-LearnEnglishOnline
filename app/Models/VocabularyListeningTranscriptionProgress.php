<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VocabularyListeningTranscriptionProgress extends Model
{
    use SoftDeletes;

    protected $table = 'vocabulary_listening_transcription_progress';

    protected $fillable = [
        'student_id',
        'transcription_id',
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
        'completed_items' => 'array',
        'scores_history' => 'array',
        'last_attempt' => 'datetime',
        'min_score_achieved' => 'boolean'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function transcription()
    {
        return $this->belongsTo(VocabularyListeningTranscription::class, 'transcription_id');
    }
}
