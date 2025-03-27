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
            $table->foreignId('original_lesson_video_id')->nullable()->comment('Liên kết tới lesson_videos cũ');
            $table->nullableMorphs('resourceable');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_extension')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->string('file_url')->nullable();
            $table->string('external_url')->nullable();
            $table->string('preview_path')->nullable();
            $table->string('category')->nullable();
            $table->enum('resource_level', ['beginner', 'intermediate', 'advanced', 'all'])->default('all');
            $table->enum('access_type', ['free', 'enrolled', 'premium'])->default('enrolled');
            $table->boolean('is_downloadable')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('duration')->nullable();
            $table->integer('download_count')->default(0);
            $table->boolean('is_public')->default(true);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
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