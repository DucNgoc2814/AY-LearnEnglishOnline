<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions');
            $table->string('answer')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->enum('type', ['single', 'multiple'])->default('single');
            $table->integer('order_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}