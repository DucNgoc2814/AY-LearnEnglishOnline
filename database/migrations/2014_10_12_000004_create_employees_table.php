<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('employee_code')->unique()->comment('Mã nhân viên');  
            $table->string('name')->comment('Tên nhân viên');
            $table->string('position')->comment('Chức vụ');
            $table->string('department')->comment('Phòng ban');
            $table->enum('employee_role', ['admin', 'manager', 'teacher', 'support', 'content_creator', 'marketing', 'sales'])->default('support')->comment('Vai trò nhân viên');
            $table->json('role_permissions')->nullable()->comment('Các quyền của nhân viên');
            $table->string('email')->nullable()->comment('Email công việc');
            $table->string('phone')->nullable()->comment('Số điện thoại');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hoạt động');
            $table->date('join_date')->nullable()->comment('Ngày vào làm');
            $table->date('resignation_date')->nullable()->comment('Ngày nghỉ việc');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
} 