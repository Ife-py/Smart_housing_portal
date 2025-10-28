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
        Schema::table('complaints', function (Blueprint $table) {
            if (! Schema::hasColumn('complaints', 'landlord_acknowledged')) {
                $table->boolean('landlord_acknowledged')->default(false)->after('is_read_by_tenant');
            }
            if (! Schema::hasColumn('complaints', 'tenant_acknowledged')) {
                $table->boolean('tenant_acknowledged')->default(false)->after('landlord_acknowledged');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            if (Schema::hasColumn('complaints', 'tenant_acknowledged')) {
                $table->dropColumn('tenant_acknowledged');
            }
            if (Schema::hasColumn('complaints', 'landlord_acknowledged')) {
                $table->dropColumn('landlord_acknowledged');
            }
        });
    }
};
