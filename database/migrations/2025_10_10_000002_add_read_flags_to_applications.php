<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            // Add read flags without specifying column order to avoid dependency on other columns
            if (! Schema::hasColumn('applications', 'is_read_by_landlord')) {
                $table->boolean('is_read_by_landlord')->default(false);
            }
            if (! Schema::hasColumn('applications', 'is_read_by_tenant')) {
                $table->boolean('is_read_by_tenant')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['is_read_by_landlord', 'is_read_by_tenant']);
        });
    }
};
