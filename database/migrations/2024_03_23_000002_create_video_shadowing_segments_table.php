<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_shadowing_segments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_shadowing_id')->constrained('video_shadowing')->onDelete('cascade');
            $table->integer('start_time'); // Thời gian bắt đầu (tính bằng giây)
            $table->integer('end_time');   // Thời gian kết thúc (tính bằng giây)
            $table->text('english_text');  // Văn bản tiếng Anh
            $table->text('vietnamese_text'); // Văn bản tiếng Việt
            $table->integer('order_index')->default(0); // Thứ tự của đoạn
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_shadowing_segments');
    }
};
