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
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('courseId')->constrained('courses');
            $table->foreignId('lessonId')->nullable()->constrained('lessons');
            $table->string('progressType');
            $table->integer('progressValue');
            $table->dateTime('timestamp');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
