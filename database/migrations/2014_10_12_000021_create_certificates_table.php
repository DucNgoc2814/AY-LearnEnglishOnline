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
            $table->foreignId('enrollment_id')->constrained('enrollments');
            $table->string('certificate_number')->unique();
            $table->string('title');
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->string('certificate_url')->nullable();
            $table->json('meta_data')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->string('verification_code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
} 