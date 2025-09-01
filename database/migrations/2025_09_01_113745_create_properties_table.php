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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landlord_id');
            $table->string('title');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->decimal('price', 12, 2);
            $table->string('type');
            $table->text('description');
            $table->text('features')->nullable(); // comma separated
            $table->json('images')->nullable(); // store image paths as JSON array
            $table->string('cover_image')->nullable(); // path to cover image
            $table->timestamps();

            $table->foreign('landlord_id')->references('id')->on('landlords')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
