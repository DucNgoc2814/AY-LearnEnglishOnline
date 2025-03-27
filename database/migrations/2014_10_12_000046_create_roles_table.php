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
        Schema::table('employees', function (Blueprint $table) {
            // Remove the old role_permissions column if it exists
            if (Schema::hasColumn('employees', 'role_permissions')) {
                $table->dropColumn('role_permissions');
            }
            
            // Remove the old employee_role column if it exists
            if (Schema::hasColumn('employees', 'employee_role')) {
                $table->dropColumn('employee_role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Add back the columns if they need to be restored
            $table->json('role_permissions')->nullable();
            $table->enum('employee_role', [
                'admin',
                'manager',
                'teacher',
                'content_creator',
                'support',
                'marketing',
                'sales'
            ])->default('support');
        });
    }
}; 