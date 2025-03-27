<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use Illuminate\Support\Str;

class CertificateSeeder extends Seeder
{
    public function run()
    {
        $certificates = [
            [
                'user_id' => 3,
                'course_id' => 1,
                'enrollment_id' => 1,
                'certificate_number' => Certificate::generateCertificateNumber(),
                'verification_code' => Str::uuid(),
                'title' => 'Laravel Basics Certificate',
                'issue_date' => '2024-03-15',
                'expiry_date' => '2026-03-15',
                'certificate_url' => 'certificates/laravel-basics-user3.pdf',
                'meta_data' => json_encode([
                    'grade' => 'A',
                    'completion_percentage' => 100,
                    'hours_spent' => 40
                ]),
                'is_verified' => true
            ],
            // Thêm 9 certificate khác...
        ];

        foreach ($certificates as $certificate) {
            Certificate::create($certificate);
        }
    }
}