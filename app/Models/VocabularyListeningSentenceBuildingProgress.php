<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VocabularyListeningSentenceBuildingProgress extends Model
{
    use SoftDeletes;

    protected $table = 'vocabulary_listening_sentence_building_progress';

    protected $fillable = [
        'student_id',
        'sentence_building_id',
        'progress',
        'retries',
        'current_position',
        'completed_count',
        'attempts',
        'scores_history',
        'last_attempt'
    ];

    protected $casts = [
        'attempts' => 'array',
        'scores_history' => 'array',
        'last_attempt' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function sentenceBuilding()
    {
        return $this->belongsTo(VocabularyListeningSentenceBuilding::class);
    }
}
