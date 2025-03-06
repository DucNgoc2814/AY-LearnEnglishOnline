<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoRecord;

class VideoRecordSeeder extends Seeder
{
    public function run()
    {
        VideoRecord::create([
            'zoomSessionId' => 1,
            'linkVideo' => 'http://example.com/video_record',
            'uploadDate' => now(),
        ]);
    }
}
