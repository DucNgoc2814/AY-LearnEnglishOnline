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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->string('studentCode')->unique();
            $table->string('fullName');
            $table->date('dateOfBirth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            
            // Thông tin phụ huynh 1
            $table->string('parent1Name')->nullable();
            $table->enum('parent1Relationship', ['father', 'mother', 'guardian', 'other'])->nullable();
            $table->string('parent1Phone')->nullable();
            $table->string('parent1Email')->nullable();
            $table->string('parent1Occupation')->nullable();
            $table->boolean('parent1IsEmergencyContact')->default(false);
            
            // Thông tin phụ huynh 2 (nếu có)
            $table->string('parent2Name')->nullable();
            $table->enum('parent2Relationship', ['father', 'mother', 'guardian', 'other'])->nullable();
            $table->string('parent2Phone')->nullable();
            $table->string('parent2Email')->nullable();
            $table->string('parent2Occupation')->nullable();
            $table->boolean('parent2IsEmergencyContact')->default(false);
            
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
}; 