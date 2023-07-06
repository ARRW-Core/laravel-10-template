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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->foreignId('id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('country', 2)->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
