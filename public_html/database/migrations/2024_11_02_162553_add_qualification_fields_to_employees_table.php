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
            $table->string('bachelor_qualification', 255)->nullable()->after('bachelor_speciality');
            $table->string('master_qualification', 255)->nullable()->after('master_speciality');
            $table->string('specialist_qualification', 255)->nullable()->after('specialist_speciality');
            $table->string('phd_qualification', 255)->nullable()->after('phd_speciality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('bachelor_qualification');
            $table->dropColumn('master_qualification');
            $table->dropColumn('specialist_qualification');
            $table->dropColumn('phd_qualification');
        });
    }
};
