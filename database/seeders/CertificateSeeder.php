<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    public function run()
    {
        Certificate::create([
            'userId' => 1,
            'courseId' => 1,
            'issueDate' => now(),
            'file' => 'path/to/certificate.pdf',
        ]);
    }
}
