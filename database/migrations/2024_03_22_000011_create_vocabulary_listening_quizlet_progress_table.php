<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vocabulary_listening_quizlet_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->comment('ID của học viên')->constrained('students')->onDelete('cascade');
            $table->foreignId('quizlet_id')->comment('ID của Quizlet')->constrained('vocabulary_listening_quizlets')->onDelete('cascade');
            $table->boolean('flashcards_completed')->default(false)->comment('Đã hoàn thành phần Flashcards');
            $table->boolean('learn_completed')->default(false)->comment('Đã hoàn thành phần Learn');
            $table->boolean('write_completed')->default(false)->comment('Đã hoàn thành phần Write');
            $table->boolean('test_completed')->default(false)->comment('Đã hoàn thành phần Test');
            $table->decimal('progress', 5, 2)->default(0)->comment('Tiến độ học từ vựng trên Quizlet (%)');
            $table->timestamp('last_activity')->nullable()->comment('Thời gian hoạt động cuối cùng');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'quizlet_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('vocabulary_listening_quizlet_progress');
    }
};
