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
        Schema::table('users', function (Blueprint $table) {
            //user_role_id
            $table->foreignId('user_role_id')->nullable()->constrained('user_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //drop user_role_id
            $table->dropForeign(['user_role_id']);
            // drop column
            $table->dropColumn('user_role_id');
        });
    }
};
