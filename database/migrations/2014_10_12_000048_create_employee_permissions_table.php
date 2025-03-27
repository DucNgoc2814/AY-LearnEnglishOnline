<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Tên quyền');
            $table->string('slug')->unique()->comment('Định danh quyền');
            $table->text('description')->nullable()->comment('Mô tả quyền');
            $table->string('module')->nullable()->comment('Module liên quan');
            $table->string('action')->comment('Hành động: view, create, edit, delete');
            $table->boolean('is_system')->default(false)->comment('Quyền hệ thống không thể xóa');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->timestamps();
            $table->softDeletes();
            
            // Tạo index để tìm kiếm nhanh
            $table->index(['module', 'action']);
        });

        // Thêm các quyền mặc định
        $permissions = [
            // Quyền quản lý khóa học
            ['name' => 'View Courses', 'slug' => 'view-courses', 'description' => 'Xem danh sách khóa học', 'module' => 'courses', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Course', 'slug' => 'create-course', 'description' => 'Tạo khóa học mới', 'module' => 'courses', 'action' => 'create', 'is_system' => true],
            ['name' => 'Edit Course', 'slug' => 'edit-course', 'description' => 'Chỉnh sửa khóa học', 'module' => 'courses', 'action' => 'edit', 'is_system' => true],
            ['name' => 'Delete Course', 'slug' => 'delete-course', 'description' => 'Xóa khóa học', 'module' => 'courses', 'action' => 'delete', 'is_system' => true],
            
            // Quyền quản lý lớp học
            ['name' => 'View Classes', 'slug' => 'view-classes', 'description' => 'Xem danh sách lớp học', 'module' => 'classes', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Class', 'slug' => 'create-class', 'description' => 'Tạo lớp học mới', 'module' => 'classes', 'action' => 'create', 'is_system' => true],
            ['name' => 'Edit Class', 'slug' => 'edit-class', 'description' => 'Chỉnh sửa lớp học', 'module' => 'classes', 'action' => 'edit', 'is_system' => true],
            ['name' => 'Delete Class', 'slug' => 'delete-class', 'description' => 'Xóa lớp học', 'module' => 'classes', 'action' => 'delete', 'is_system' => true],
            
            // Quyền quản lý học viên
            ['name' => 'View Students', 'slug' => 'view-students', 'description' => 'Xem danh sách học viên', 'module' => 'students', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Student', 'slug' => 'create-student', 'description' => 'Tạo học viên mới', 'module' => 'students', 'action' => 'create', 'is_system' => true],
            ['name' => 'Edit Student', 'slug' => 'edit-student', 'description' => 'Chỉnh sửa học viên', 'module' => 'students', 'action' => 'edit', 'is_system' => true],
            ['name' => 'Delete Student', 'slug' => 'delete-student', 'description' => 'Xóa học viên', 'module' => 'students', 'action' => 'delete', 'is_system' => true],
            
            // Quyền quản lý nhân viên
            ['name' => 'View Employees', 'slug' => 'view-employees', 'description' => 'Xem danh sách nhân viên', 'module' => 'employees', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Employee', 'slug' => 'create-employee', 'description' => 'Tạo nhân viên mới', 'module' => 'employees', 'action' => 'create', 'is_system' => true],
            ['name' => 'Edit Employee', 'slug' => 'edit-employee', 'description' => 'Chỉnh sửa nhân viên', 'module' => 'employees', 'action' => 'edit', 'is_system' => true],
            ['name' => 'Delete Employee', 'slug' => 'delete-employee', 'description' => 'Xóa nhân viên', 'module' => 'employees', 'action' => 'delete', 'is_system' => true],
            
            // Quyền quản lý tài liệu
            ['name' => 'View Resources', 'slug' => 'view-resources', 'description' => 'Xem danh sách tài liệu', 'module' => 'resources', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Resource', 'slug' => 'create-resource', 'description' => 'Tạo tài liệu mới', 'module' => 'resources', 'action' => 'create', 'is_system' => true],
            ['name' => 'Edit Resource', 'slug' => 'edit-resource', 'description' => 'Chỉnh sửa tài liệu', 'module' => 'resources', 'action' => 'edit', 'is_system' => true],
            ['name' => 'Delete Resource', 'slug' => 'delete-resource', 'description' => 'Xóa tài liệu', 'module' => 'resources', 'action' => 'delete', 'is_system' => true],
            
            // Quyền quản lý đơn hàng
            ['name' => 'View Orders', 'slug' => 'view-orders', 'description' => 'Xem danh sách đơn hàng', 'module' => 'orders', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Order', 'slug' => 'create-order', 'description' => 'Tạo đơn hàng mới', 'module' => 'orders', 'action' => 'create', 'is_system' => true],
            ['name' => 'Edit Order', 'slug' => 'edit-order', 'description' => 'Chỉnh sửa đơn hàng', 'module' => 'orders', 'action' => 'edit', 'is_system' => true],
            ['name' => 'Delete Order', 'slug' => 'delete-order', 'description' => 'Xóa đơn hàng', 'module' => 'orders', 'action' => 'delete', 'is_system' => true],
            
            // Quyền quản lý báo cáo
            ['name' => 'View Reports', 'slug' => 'view-reports', 'description' => 'Xem báo cáo', 'module' => 'reports', 'action' => 'view', 'is_system' => true],
            ['name' => 'Create Report', 'slug' => 'create-report', 'description' => 'Tạo báo cáo mới', 'module' => 'reports', 'action' => 'create', 'is_system' => true],
            ['name' => 'Export Report', 'slug' => 'export-report', 'description' => 'Xuất báo cáo', 'module' => 'reports', 'action' => 'export', 'is_system' => true],
            
            // Quyền phân quyền
            ['name' => 'Manage Permissions', 'slug' => 'manage-permissions', 'description' => 'Quản lý phân quyền', 'module' => 'permissions', 'action' => 'manage', 'is_system' => true],
        ];

        // Thêm created_at và updated_at cho mỗi quyền
        foreach ($permissions as &$permission) {
            $permission['created_at'] = now();
            $permission['updated_at'] = now();
        }
        
        DB::table('employee_permissions')->insert($permissions);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_permissions');
    }
}; 