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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->morphs('resourceable');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_type');
            $table->enum('resource_level', ['beginner', 'intermediate', 'advanced', 'all'])->default('all');
            $table->enum('access_type', ['free', 'enrolled', 'premium'])->default('enrolled');
            $table->boolean('downloadable')->default(false);
            $table->integer('duration')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('original_lesson_video_id')->nullable()->comment('Liên kết tới lesson_videos cũ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
}; 