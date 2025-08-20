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
        Schema::create('landlords', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('id_number')->nullable();
            $table->string('id_type')->nullable();
            $table->string('properties_count')->default(0);
            $table->string('contact_method')->default('email');
            $table->date('date_of_birth')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('password');
            $table->boolean('active')->default(1); // 1 for active, 0 for inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landlords');
    }
};
