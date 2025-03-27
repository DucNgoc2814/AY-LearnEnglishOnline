<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('class_session_id')->nullable()->constrained('class_sessions')
                ->comment('Buổi học mà bài test được làm (nếu là session_test)');
            $table->integer('score')->comment('Điểm số đạt được');
            $table->integer('total_questions')->comment('Tổng số câu hỏi');
            $table->integer('correct_answers')->comment('Số câu trả lời đúng');
            $table->integer('attempt_number')->comment('Lần thi thứ mấy');
            $table->timestamp('started_at')->comment('Thời gian bắt đầu làm bài');
            $table->timestamp('completed_at')->nullable()->comment('Thời gian nộp bài');
            $table->enum('status', [
                'in_progress',    // Đang làm bài
                'completed',      // Đã hoàn thành
                'timeout',        // Hết thời gian làm bài
                'abandoned'       // Bỏ dở
            ])->default('in_progress');
            $table->json('meta_data')->nullable()->comment('Dữ liệu bổ sung (thời gian làm từng câu, IP...)');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_results');
    }
} 