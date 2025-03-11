<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZoomSession;
use Illuminate\Support\Str;

class ZoomSessionSeeder extends Seeder
{
    public function run()
    {
        ZoomSession::create([
            'name' => 'Buổi học trực tuyến 1',
            'slug' => Str::slug('Buổi học trực tuyến 1'),
            'zoomUrl' => 'https://zoom.us/j/123456789',
            'courseId' => 1,
            'releaseTime' => now(),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);

        ZoomSession::create([
            'name' => 'Buổi học trực tuyến 2',
            'slug' => Str::slug('Buổi học trực tuyến 2'),
            'zoomUrl' => 'https://zoom.us/j/987654321',
            'courseId' => 2,
            'releaseTime' => now()->addDays(1),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);

        ZoomSession::create([
            'name' => 'Buổi học trực tuyến 3',
            'slug' => Str::slug('Buổi học trực tuyến 3'),
            'zoomUrl' => 'https://zoom.us/j/456789123',
            'courseId' => 3,
            'releaseTime' => now()->addDays(2),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);

        ZoomSession::create([
            'name' => 'Buổi học trực tuyến 4',
            'slug' => Str::slug('Buổi học trực tuyến 4'),
            'zoomUrl' => 'https://zoom.us/j/111222333',
            'courseId' => 4,
            'releaseTime' => now()->addDays(3),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);

        ZoomSession::create([
            'name' => 'Buổi học trực tuyến 5',
            'slug' => Str::slug('Buổi học trực tuyến 5'),
            'zoomUrl' => 'https://zoom.us/j/444555666',
            'courseId' => 5,
            'releaseTime' => now()->addDays(4),
            'recordingLink' => null,
            'status' => 'scheduled'
        ]);
    }
}
