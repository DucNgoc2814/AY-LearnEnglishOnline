<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests');
            $table->enum('type', ['text', 'image', 'video', 'audio']);
            $table->integer('role')->default(0)->nullable()->comment('loại câu hỏi: 1 - trắc nghiệm, 2 - tự luận');
            $table->text('question');
            $table->string('media_url')->nullable();
            $table->text('correct_answer_explanation')->nullable();
            $table->integer('order_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}