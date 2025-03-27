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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('student_code')->unique();
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            
            // Thông tin phụ huynh 1
            $table->string('parent1_name')->nullable();
            $table->enum('parent1_relationship', ['father', 'mother', 'guardian', 'other'])->nullable();
            $table->string('parent1_phone')->nullable();
            $table->string('parent1_email')->nullable();
            $table->string('parent1_occupation')->nullable();
            $table->boolean('parent1_is_emergency_contact')->default(false);
            
            // Thông tin phụ huynh 2 (nếu có)
            $table->string('parent2_name')->nullable();
            $table->enum('parent2_relationship', ['father', 'mother', 'guardian', 'other'])->nullable();
            $table->string('parent2_phone')->nullable();
            $table->string('parent2_email')->nullable();
            $table->string('parent2_occupation')->nullable();
            $table->boolean('parent2_is_emergency_contact')->default(false);
            
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
        Schema::dropIfExists('students');
    }
}; 