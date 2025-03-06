<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'zoomSessionId', 'linkVideo', 'uploadDate'
    ];

    public function zoomSession()
    {
        return $this->belongsTo(ZoomSession::class);
    }
}
