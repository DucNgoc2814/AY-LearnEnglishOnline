<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_shadowing_recordings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_shadowing_id')->constrained('video_shadowings')->onDelete('cascade');
            $table->foreignId('segment_id')->constrained('video_shadowing_segments')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('recording_url'); // URL đến file ghi âm
            $table->integer('duration')->nullable(); // Độ dài của bản ghi âm (giây)
            $table->float('accuracy_score')->nullable(); // Điểm số độ chính xác (nếu có AI scoring)
            $table->text('feedback')->nullable(); // Phản hồi từ giáo viên hoặc hệ thống
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_shadowing_recordings');
    }
};
