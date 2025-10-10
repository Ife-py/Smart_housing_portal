<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('landlord_id')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('open');
            $table->json('attachments')->nullable();
            $table->boolean('is_read_by_landlord')->default(false);
            $table->boolean('is_read_by_tenant')->default(false);
            $table->timestamps();

            $table->index('tenant_id');
            $table->index('landlord_id');
            $table->index('property_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
