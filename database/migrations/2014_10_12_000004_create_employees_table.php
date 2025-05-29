<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique()->comment('Mã nhân viên');
            $table->string('name')->comment('Tên nhân viên');
            $table->string('position')->comment('Chức vụ');
            $table->string('department')->comment('Phòng ban');
            $table->string('email');
            $table->string('password');
            $table->string('phone')->nullable()->comment('Số điện thoại');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hoạt động');
            $table->date('join_date')->nullable()->comment('Ngày vào làm');
            $table->date('resignation_date')->nullable()->comment('Ngày nghỉ việc');
            $table->enum('role', ['teacher', 'teaching_assistant', 'admin', 'staff'])->nullable()->comment('Vai trò');
            $table->text('note')->nullable()->comment('Ghi chú');

            // Authentication fields
            $table->string('device_id')->nullable();
            $table->string('browser_id')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->text('active_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->boolean('is_testing')->default(false);
            $table->string('login_lock')->nullable();
            $table->timestamp('login_lock_expires_at')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
