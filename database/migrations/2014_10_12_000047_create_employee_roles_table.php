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
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Tên vai trò');
            $table->string('slug')->unique()->comment('Định danh vai trò');
            $table->text('description')->nullable()->comment('Mô tả vai trò');
            $table->boolean('is_system')->default(false)->comment('Vai trò hệ thống không thể xóa');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->integer('level')->default(1)->comment('Cấp độ vai trò, cao hơn có quyền hơn');
            $table->timestamps();
            $table->softDeletes();
        });

        // Thêm các vai trò mặc định
        DB::table('employee_roles')->insert([
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Quản trị viên với toàn quyền', 'is_system' => true, 'level' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manager', 'slug' => 'manager', 'description' => 'Quản lý', 'is_system' => true, 'level' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teacher', 'slug' => 'teacher', 'description' => 'Giáo viên', 'is_system' => true, 'level' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Content Creator', 'slug' => 'content-creator', 'description' => 'Người tạo nội dung', 'is_system' => true, 'level' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Support', 'slug' => 'support', 'description' => 'Nhân viên hỗ trợ', 'is_system' => true, 'level' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing', 'slug' => 'marketing', 'description' => 'Nhân viên marketing', 'is_system' => true, 'level' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sales', 'slug' => 'sales', 'description' => 'Nhân viên kinh doanh', 'is_system' => true, 'level' => 30, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_roles');
    }
}; 