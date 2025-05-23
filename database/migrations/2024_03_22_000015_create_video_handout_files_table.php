<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_handout_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->comment('ID của bài học')->constrained('video_handout_lessons')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề của handout');
            $table->text('description')->nullable()->comment('Mô tả về handout');
            $table->string('file_path')->comment('Đường dẫn đến file PDF');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_handout_files');
    }
};
