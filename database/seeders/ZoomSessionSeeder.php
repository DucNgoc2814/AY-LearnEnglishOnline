<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZoomSession;

class ZoomSessionSeeder extends Seeder
{
    public function run()
    {
        ZoomSession::create([
            'lessonId' => 1,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'lessonId' => 2,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'lessonId' => 3,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'lessonId' => 4,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'lessonId' => 5,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
    }
}
