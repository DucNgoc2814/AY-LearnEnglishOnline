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
        Schema::create('employee_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_role_id')->constrained('employee_roles')->onDelete('cascade');
            $table->foreignId('employee_permission_id')->constrained('employee_permissions')->onDelete('cascade');
            $table->timestamps();
            
            // Tạo unique constraint để tránh trùng lặp
            $table->unique(['employee_role_id', 'employee_permission_id'], 'role_permission_unique');
        });
        
        // Cấp quyền cho các vai trò mặc định
        $this->seedDefaultRolePermissions();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_role_permissions');
    }
    
    /**
     * Seed dữ liệu mặc định cho employee_role_permissions
     */
    private function seedDefaultRolePermissions(): void
    {
        try {
            // Lấy ID của các vai trò
            $adminRoleId = DB::table('employee_roles')->where('slug', 'admin')->value('id');
            $managerRoleId = DB::table('employee_roles')->where('slug', 'manager')->value('id');
            $teacherRoleId = DB::table('employee_roles')->where('slug', 'teacher')->value('id');
            $contentCreatorRoleId = DB::table('employee_roles')->where('slug', 'content-creator')->value('id');
            $supportRoleId = DB::table('employee_roles')->where('slug', 'support')->value('id');
            
            // Lấy tất cả quyền
            $allPermissions = DB::table('employee_permissions')->pluck('id')->toArray();
            
            // Lấy quyền theo module
            $coursePermissions = DB::table('employee_permissions')->where('module', 'courses')->pluck('id')->toArray();
            $classPermissions = DB::table('employee_permissions')->where('module', 'classes')->pluck('id')->toArray();
            $studentPermissions = DB::table('employee_permissions')->where('module', 'students')->pluck('id')->toArray();
            $resourcePermissions = DB::table('employee_permissions')->where('module', 'resources')->pluck('id')->toArray();
            $orderPermissions = DB::table('employee_permissions')->where('module', 'orders')->pluck('id')->toArray();
            $reportViewPermission = DB::table('employee_permissions')->where('slug', 'view-reports')->value('id');
            
            // Cấp tất cả quyền cho admin
            $adminPermissions = array_map(function($permissionId) use ($adminRoleId) {
                return [
                    'employee_role_id' => $adminRoleId,
                    'employee_permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $allPermissions);
            
            // Cấp quyền cho Manager
            $managerPermissions = array_merge(
                $coursePermissions,
                $classPermissions,
                $studentPermissions,
                $resourcePermissions,
                $orderPermissions,
                [$reportViewPermission]
            );
            
            $managerPermissions = array_map(function($permissionId) use ($managerRoleId) {
                return [
                    'employee_role_id' => $managerRoleId,
                    'employee_permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $managerPermissions);
            
            // Cấp quyền cho Teacher
            $teacherPermissionIds = array_merge(
                [
                    DB::table('employee_permissions')->where('slug', 'view-courses')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-classes')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'edit-class')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-students')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-resources')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'create-resource')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'edit-resource')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-reports')->value('id')
                ]
            );
            
            $teacherPermissions = array_map(function($permissionId) use ($teacherRoleId) {
                return [
                    'employee_role_id' => $teacherRoleId,
                    'employee_permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $teacherPermissionIds);
            
            // Cấp quyền cho Content Creator
            $contentCreatorPermissionIds = array_merge(
                [
                    DB::table('employee_permissions')->where('slug', 'view-courses')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'create-course')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'edit-course')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-resources')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'create-resource')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'edit-resource')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'delete-resource')->value('id')
                ]
            );
            
            $contentCreatorPermissions = array_map(function($permissionId) use ($contentCreatorRoleId) {
                return [
                    'employee_role_id' => $contentCreatorRoleId,
                    'employee_permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $contentCreatorPermissionIds);
            
            // Cấp quyền cho Support
            $supportPermissionIds = array_merge(
                [
                    DB::table('employee_permissions')->where('slug', 'view-courses')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-classes')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-students')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-resources')->value('id'),
                    DB::table('employee_permissions')->where('slug', 'view-orders')->value('id')
                ]
            );
            
            $supportPermissions = array_map(function($permissionId) use ($supportRoleId) {
                return [
                    'employee_role_id' => $supportRoleId,
                    'employee_permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }, $supportPermissionIds);
            
            // Gộp tất cả quyền để insert
            $allRolePermissions = array_merge(
                $adminPermissions,
                $managerPermissions,
                $teacherPermissions,
                $contentCreatorPermissions,
                $supportPermissions
            );
            
            // Insert vào database
            DB::table('employee_role_permissions')->insert($allRolePermissions);
            
        } catch (\Exception $e) {
            // Ghi log lỗi
            logger()->error('Error seeding default role permissions: ' . $e->getMessage());
        }
    }
}; 