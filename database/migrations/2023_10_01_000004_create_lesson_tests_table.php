<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTestsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonId')->constrained('lessons');
            $table->integer('minScore');
            $table->boolean('isRequired')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_tests');
    }
}
