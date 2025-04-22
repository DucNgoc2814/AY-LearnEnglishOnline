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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('grade_item_id')->constrained('grade_items')->onDelete('cascade');
            $table->decimal('grade', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('graded_by')->nullable()->constrained('employees');
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index(['student_id', 'class_id']);
            $table->index(['grade_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
