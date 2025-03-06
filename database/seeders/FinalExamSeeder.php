<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinalExam;

class FinalExamSeeder extends Seeder
{
    public function run()
    {
        FinalExam::create([
            'courseId' => 1,
            'minScore' => 60,
        ]);
    }
}
