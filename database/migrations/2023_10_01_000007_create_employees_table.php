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
            $table->string('employeeCode')->unique()->comment('Mã nhân viên');
            $table->string('name')->comment('Tên nhân viên');
            $table->string('position')->comment('Chức vụ');
            $table->string('department')->comment('Phòng ban');
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