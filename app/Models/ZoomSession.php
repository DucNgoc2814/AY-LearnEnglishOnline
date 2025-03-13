<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoomSession extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'zoomUrl',
        'courseId',
        'releaseTime',
        'recordingLink',
        'status'
    ];

    protected $casts = [
        'releaseTime' => 'datetime'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function videoRecords()
    {
        return $this->hasMany(VideoRecord::class, 'zoomSessionId');
    }
}
