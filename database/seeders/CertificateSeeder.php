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
            'certificateNumber' => 'CERT-001',
            'issueDate' => now(),
            'file' => 'path/to/certificate1.pdf',
            'status' => 'issued',
            'note' => null,
            'approvedBy' => null,
            'approvedAt' => null
        ]);
        Certificate::create([
            'userId' => 2,
            'courseId' => 1,
            'certificateNumber' => 'CERT-002',
            'issueDate' => now(),
            'file' => 'path/to/certificate2.pdf',
            'status' => 'issued',
            'note' => null,
            'approvedBy' => null,
            'approvedAt' => null
        ]);
        Certificate::create([
            'userId' => 3,
            'courseId' => 2,
            'certificateNumber' => 'CERT-003',
            'issueDate' => now(),
            'file' => 'path/to/certificate3.pdf',
            'status' => 'issued',
            'note' => null,
            'approvedBy' => null,
            'approvedAt' => null
        ]);
        Certificate::create([
            'userId' => 4,
            'courseId' => 2,
            'certificateNumber' => 'CERT-004',
            'issueDate' => now(),
            'file' => 'path/to/certificate4.pdf',
            'status' => 'issued',
            'note' => null,
            'approvedBy' => null,
            'approvedAt' => null
        ]);
        Certificate::create([
            'userId' => 5,
            'courseId' => 3,
            'certificateNumber' => 'CERT-005',
            'issueDate' => now(),
            'file' => 'path/to/certificate5.pdf',
            'status' => 'issued',
            'note' => null,
            'approvedBy' => null,
            'approvedAt' => null
        ]);
    }
}
