<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('video_id')->constrained('lesson_videos')->onDelete('cascade');
            $table->integer('watched_seconds')->default(0);
            $table->integer('percentage')->default(0);
            $table->boolean('completed')->default(false);
            $table->integer('last_position')->default(0);
            $table->timestamp('last_watched_at')->nullable();
            $table->integer('watch_count')->default(0);
            $table->json('meta_data')->nullable();
            $table->timestamps();

            // Add a unique constraint to prevent duplicate records
            $table->unique(['user_id', 'video_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_progress');
    }
} 