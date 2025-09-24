<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->enum('sex', ['Male', 'Female', 'Other'])->nullable()->after('phone');
        });

        Schema::table('landlords', function (Blueprint $table) {
            $table->enum('sex', ['Male', 'Female', 'Other'])->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('sex');
        });

        Schema::table('landlords', function (Blueprint $table) {
            $table->dropColumn('sex');
        });
    }
};
