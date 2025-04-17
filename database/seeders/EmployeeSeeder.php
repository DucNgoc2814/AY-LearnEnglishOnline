<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = [
            [
                'employee_code' => 'EMP001',
                'name' => 'John Doe',
                'position' => 'Senior Manager',
                'department' => 'Academic',
                'email' => 'john.doe@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234567',
                'address' => '123 Main Street, City',
                'is_active' => true,
                'join_date' => '2023-01-01',
                'role' => 'teacher',
            ],
            [
                'employee_code' => 'EMP002',
                'name' => 'Jane Smith',
                'position' => 'Senior Teacher',
                'department' => 'Technology',
                'email' => 'jane.smith@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234568',
                'address' => '456 Tech Street, City',
                'is_active' => true,
                'join_date' => '2023-02-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP003',
                'name' => 'Robert Johnson',
                'position' => 'Content Creator',
                'department' => 'Content',
                'email' => 'robert.j@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234569',
                'address' => '789 Content Ave, City',
                'is_active' => true,
                'join_date' => '2023-03-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP004',
                'name' => 'Mary Williams',
                'position' => 'Support Specialist',
                'department' => 'Student Support',
                'email' => 'mary.w@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234570',
                'address' => '321 Support St, City',
                'is_active' => true,
                'join_date' => '2023-04-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP005',
                'name' => 'David Brown',
                'position' => 'Marketing Manager',
                'department' => 'Marketing',
                'email' => 'david.b@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234571',
                'address' => '654 Marketing Rd, City',
                'is_active' => true,
                'join_date' => '2023-05-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP006',
                'name' => 'Sarah Davis',
                'position' => 'Sales Executive',
                'department' => 'Sales',
                'email' => 'sarah.d@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234572',
                'address' => '987 Sales Blvd, City',
                'is_active' => true,
                'join_date' => '2023-06-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP007',
                'name' => 'Michael Wilson',
                'position' => 'Technical Trainer',
                'department' => 'Training',
                'email' => 'michael.w@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234573',
                'address' => '147 Training Lane, City',
                'is_active' => true,
                'join_date' => '2023-07-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP008',
                'name' => 'Lisa Anderson',
                'position' => 'HR Manager',
                'department' => 'Human Resources',
                'email' => 'lisa.a@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234574',
                'address' => '258 HR Street, City',
                'is_active' => true,
                'join_date' => '2023-08-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP009',
                'name' => 'James Taylor',
                'position' => 'Finance Manager',
                'department' => 'Finance',
                'email' => 'james.t@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234575',
                'address' => '369 Finance Ave, City',
                'is_active' => true,
                'join_date' => '2023-09-01',
                'role' => 'teaching_assistant',
            ],
            [
                'employee_code' => 'EMP010',
                'name' => 'Emma Martinez',
                'position' => 'Quality Assurance',
                'department' => 'QA',
                'email' => 'emma.m@company.com',
                'password' => Hash::make('123456789'),
                'phone' => '0901234576',
                'address' => '741 QA Road, City',
                'is_active' => true,
                'join_date' => '2023-10-01',
                'role' => 'teaching_assistant',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}