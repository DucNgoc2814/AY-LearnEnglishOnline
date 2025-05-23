<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reflection_exercise_videos', function (Blueprint $table) {
            $table->id()->comment('ID của video hướng dẫn');
            $table->string('title')->comment('Tiêu đề video');
            $table->string('video_url')->comment('URL của video hướng dẫn');
            $table->text('description')->nullable()->comment('Mô tả về video');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hiển thị của video');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reflection_exercise_videos');
    }
};
