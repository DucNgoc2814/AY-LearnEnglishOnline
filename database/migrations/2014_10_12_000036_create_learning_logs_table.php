<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningLogsTable extends Migration
{
    public function up()
    {
        Schema::create('learning_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->morphs('loggable'); // Polymorphic relationship (lesson, course, exam, etc)
            $table->enum('action', [
                'viewed', 'downloaded', 'completed', 'started', 
                'attempted', 'passed', 'failed', 'resumed'
            ]);
            $table->text('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->integer('duration_seconds')->nullable();
            $table->dateTime('action_time');
            $table->json('meta_data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('learning_logs');
    }
} 