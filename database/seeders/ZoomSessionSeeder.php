<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZoomSession;

class ZoomSessionSeeder extends Seeder
{
    public function run()
    {
        ZoomSession::create([
            'courseId' => 1,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'courseId' => 2,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'courseId' => 3,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'courseId' => 4,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
        ZoomSession::create([
            'courseId' => 5,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
    }
}
