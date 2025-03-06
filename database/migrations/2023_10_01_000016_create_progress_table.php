<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollmentId')->constrained('enrollments');
            $table->foreignId('lessonId')->nullable()->constrained('lessons');
            $table->integer('progressValue');
            $table->string('status')->default('active')->comment('Trạng thái: active/completed');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
