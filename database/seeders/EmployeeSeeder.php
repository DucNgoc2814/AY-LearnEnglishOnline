<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Enums\EmployeeRole;
use Carbon\Carbon;

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
                'employee_role' => 'manager',
                'role_permissions' => json_encode(['manage_staff', 'manage_courses']),
                'email' => 'john.doe@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234567',
                'address' => '123 Main Street, City',
                'is_active' => true,
                'join_date' => '2023-01-01',
                'resignation_date' => null,
                'note' => 'Senior manager with extensive experience'
            ],
            [
                'employee_code' => 'EMP002',
                'name' => 'Jane Smith',
                'position' => 'Senior Teacher',
                'department' => 'Technology',
                'employee_role' => 'teacher',
                'role_permissions' => json_encode(['teach_courses', 'view_materials']),
                'email' => 'jane.smith@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234568',
                'address' => '456 Tech Street, City',
                'is_active' => true,
                'join_date' => '2023-02-01',
                'resignation_date' => null,
                'note' => 'Experienced technology teacher'
            ],
            [
                'employee_code' => 'EMP003',
                'name' => 'Robert Johnson',
                'position' => 'Content Creator',
                'department' => 'Content',
                'employee_role' => 'content_creator',
                'role_permissions' => json_encode(['create_content', 'edit_content']),
                'email' => 'robert.j@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234569',
                'address' => '789 Content Ave, City',
                'is_active' => true,
                'join_date' => '2023-03-01',
                'resignation_date' => null,
                'note' => 'Creative content developer'
            ],
            [
                'employee_code' => 'EMP004',
                'name' => 'Mary Williams',
                'position' => 'Support Specialist',
                'department' => 'Student Support',
                'employee_role' => 'support',
                'role_permissions' => json_encode(['support_students', 'manage_tickets']),
                'email' => 'mary.w@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234570',
                'address' => '321 Support St, City',
                'is_active' => true,
                'join_date' => '2023-04-01',
                'resignation_date' => null,
                'note' => 'Dedicated student support specialist'
            ],
            [
                'employee_code' => 'EMP005',
                'name' => 'David Brown',
                'position' => 'Marketing Manager',
                'department' => 'Marketing',
                'employee_role' => 'marketing',
                'role_permissions' => json_encode(['manage_campaigns', 'analyze_metrics']),
                'email' => 'david.b@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234571',
                'address' => '654 Marketing Rd, City',
                'is_active' => true,
                'join_date' => '2023-05-01',
                'resignation_date' => null,
                'note' => 'Marketing strategy expert'
            ],
            [
                'employee_code' => 'EMP006',
                'name' => 'Sarah Davis',
                'position' => 'Sales Executive',
                'department' => 'Sales',
                'employee_role' => 'sales',
                'role_permissions' => json_encode(['manage_leads', 'close_deals']),
                'email' => 'sarah.d@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234572',
                'address' => '987 Sales Blvd, City',
                'is_active' => true,
                'join_date' => '2023-06-01',
                'resignation_date' => null,
                'note' => 'Top performing sales executive'
            ],
            [
                'employee_code' => 'EMP007',
                'name' => 'Michael Wilson',
                'position' => 'Technical Trainer',
                'department' => 'Training',
                'employee_role' => 'teacher',
                'role_permissions' => json_encode(['teach_courses', 'develop_curriculum']),
                'email' => 'michael.w@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234573',
                'address' => '147 Training Lane, City',
                'is_active' => true,
                'join_date' => '2023-07-01',
                'resignation_date' => null,
                'note' => 'Technical training specialist'
            ],
            [
                'employee_code' => 'EMP008',
                'name' => 'Lisa Anderson',
                'position' => 'HR Manager',
                'department' => 'Human Resources',
                'employee_role' => 'admin',
                'role_permissions' => json_encode(['manage_employees', 'handle_payroll']),
                'email' => 'lisa.a@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234574',
                'address' => '258 HR Street, City',
                'is_active' => true,
                'join_date' => '2023-08-01',
                'resignation_date' => null,
                'note' => 'HR administration and management'
            ],
            [
                'employee_code' => 'EMP009',
                'name' => 'James Taylor',
                'position' => 'Finance Manager',
                'department' => 'Finance',
                'employee_role' => 'manager',
                'role_permissions' => json_encode(['manage_finance', 'approve_expenses']),
                'email' => 'james.t@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234575',
                'address' => '369 Finance Ave, City',
                'is_active' => true,
                'join_date' => '2023-09-01',
                'resignation_date' => null,
                'note' => 'Financial operations manager'
            ],
            [
                'employee_code' => 'EMP010',
                'name' => 'Emma Martinez',
                'position' => 'Quality Assurance',
                'department' => 'QA',
                'employee_role' => 'support',
                'role_permissions' => json_encode(['test_courses', 'report_issues']),
                'email' => 'emma.m@company.com',
                'password' => bcrypt('123456789'),
                'phone' => '0901234576',
                'address' => '741 QA Road, City',
                'is_active' => true,
                'join_date' => '2023-10-01',
                'resignation_date' => null,
                'note' => 'Quality assurance specialist'
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
