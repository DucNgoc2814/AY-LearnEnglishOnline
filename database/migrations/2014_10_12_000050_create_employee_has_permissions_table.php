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
        Schema::create('employee_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('employee_permission_id')->constrained('employee_permissions')->onDelete('cascade');
            $table->boolean('is_granted')->default(true)->comment('true = cấp quyền, false = từ chối quyền');
            $table->timestamps();
            
            // Tạo unique constraint để tránh trùng lặp
            $table->unique(['employee_id', 'employee_permission_id'], 'employee_permission_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_has_permissions');
    }
}; 