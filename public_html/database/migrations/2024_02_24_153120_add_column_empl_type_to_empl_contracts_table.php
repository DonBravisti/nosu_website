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
        // Schema::disableForeignKeyConstraints();
        Schema::table('empl_contracts', function (Blueprint $table) {
            $table->foreignId('empl_contract_type')->default(1)->after('position_id')->constrained();
        });
        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empl_contracts', function (Blueprint $table) {
            $table->dropColumn('empl_contract_type');
        });
    }
};
