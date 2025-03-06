<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoRecord;

class VideoRecordSeeder extends Seeder
{
    public function run()
    {
        VideoRecord::create(['zoomSessionId' => 1, 'linkVideo' => 'http://example.com/video_record1', 'uploadDate' => now()]);
        VideoRecord::create(['zoomSessionId' => 1, 'linkVideo' => 'http://example.com/video_record2', 'uploadDate' => now()]);
        VideoRecord::create(['zoomSessionId' => 2, 'linkVideo' => 'http://example.com/video_record3', 'uploadDate' => now()]);
        VideoRecord::create(['zoomSessionId' => 2, 'linkVideo' => 'http://example.com/video_record4', 'uploadDate' => now()]);
        VideoRecord::create(['zoomSessionId' => 3, 'linkVideo' => 'http://example.com/video_record5', 'uploadDate' => now()]);
    }
}
