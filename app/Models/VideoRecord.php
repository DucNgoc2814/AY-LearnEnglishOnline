<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'zoomSessionId',
        'linkVideo',
        'uploadDate'
    ];

    protected $casts = [
        'uploadDate' => 'datetime'
    ];

    public function zoomSession()
    {
        return $this->belongsTo(ZoomSession::class, 'zoomSessionId');
    }
} 