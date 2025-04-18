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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('teacher_id')->constrained('employees')->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->date('enrollment_deadline')->nullable();
            $table->integer('max_students')->default(30);
            $table->integer('min_students')->default(5);
            $table->integer('current_students')->default(0);
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            $table->text('description')->nullable();
            $table->json('schedule')->nullable();
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
        Schema::dropIfExists('classes');
    }
};