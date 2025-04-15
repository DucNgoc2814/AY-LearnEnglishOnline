<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('video_url');
            $table->integer('duration')->nullable()->comment('Độ dài video (giây)');
            $table->string('video_type')->nullable()->comment('Định dạng video');
            $table->string('thumbnail_url')->nullable()->comment('Ảnh thumbnail của video');
            $table->boolean('is_downloadable')->default(false);
            $table->boolean('is_preview')->default(false);
            $table->integer('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_videos');
    }
}; 