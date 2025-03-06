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
            'startTime' => now(),
            'endTime' => now()->addHours(1),
            'participants' => json_encode([1]),
            'recordingLink' => null,
        ]);
    }
}
