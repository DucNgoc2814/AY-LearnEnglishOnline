<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('zoom_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lessonId')->constrained('lessons');
            $table->dateTime('startTime');
            $table->dateTime('endTime');
            $table->json('participants')->nullable();
            $table->string('recordingLink')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zoom_sessions');
    }
}
