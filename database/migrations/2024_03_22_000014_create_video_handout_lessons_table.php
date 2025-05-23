<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_handout_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->comment('ID của unit')->constrained('video_handout_units')->onDelete('cascade');
            $table->string('title')->comment('Tiêu đề bài học (Greeting and Introduction, ...)');
            $table->text('description')->nullable()->comment('Mô tả về bài học');
            $table->string('video_url')->comment('URL của video');
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị trong unit');
            $table->boolean('is_active')->default(true)->comment('Trạng thái kích hoạt');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_handout_lessons');
    }
};
