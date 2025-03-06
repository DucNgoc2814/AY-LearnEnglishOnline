<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('courseId')->constrained('courses');
            $table->string('type');
            $table->string('linkVideo')->nullable();
            $table->string('linkZoom')->nullable();
            $table->dateTime('startTime')->nullable();
            $table->dateTime('endTime')->nullable();
            $table->integer('duration')->nullable();
            $table->json('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
