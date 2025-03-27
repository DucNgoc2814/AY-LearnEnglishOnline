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
            $table->foreignId('user_id')->constrained('users');  
            $table->foreignId('course_id')->constrained('courses');
            $table->string('certificate_number')->unique()->comment('Số hiệu chứng chỉ');
            $table->dateTime('issue_date')->comment('Ngày cấp chứng chỉ');
            $table->string('file')->comment('File chứng chỉ');
            $table->string('status')->default('pending')->comment('Trạng thái: pending/approved/rejected');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->foreignId('approved_by')->nullable()->constrained('employees')->comment('Người duyệt chứng chỉ');
            $table->dateTime('approved_at')->nullable()->comment('Thời gian duyệt');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
