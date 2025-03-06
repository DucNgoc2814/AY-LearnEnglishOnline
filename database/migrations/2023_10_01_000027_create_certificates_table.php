<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('courseId')->constrained('courses');
            $table->string('certificateNumber')->unique()->comment('Số hiệu chứng chỉ');
            $table->dateTime('issueDate')->comment('Ngày cấp chứng chỉ');
            $table->string('file')->comment('File chứng chỉ');
            $table->string('status')->default('pending')->comment('Trạng thái: pending/approved/rejected');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->foreignId('approvedBy')->nullable()->constrained('employees')->comment('Người duyệt chứng chỉ');
            $table->dateTime('approvedAt')->nullable()->comment('Thời gian duyệt');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
