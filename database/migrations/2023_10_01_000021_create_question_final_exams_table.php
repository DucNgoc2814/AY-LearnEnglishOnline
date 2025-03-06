<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionFinalExamsTable extends Migration
{
    public function up()
    {
        Schema::create('question_final_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finalExamId')->constrained('final_exams');
            $table->string('question');
                $table->integer('STT');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_final_exams');
    }
}
