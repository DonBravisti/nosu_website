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
            $table->renameColumn('bachelor', 'bachelor_speciality');
            $table->renameColumn('master', 'master_speciality');
            $table->renameColumn('specialist', 'specialist_speciality');
            $table->renameColumn('phd', 'phd_speciality');

            $table->dropColumn('doctorate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('doctorate', 255)->nullable()->after('phd_qualification');

            $table->renameColumn('bachelor_speciality', 'bachelor');
            $table->renameColumn('master_speciality', 'master');
            $table->renameColumn('specialist_speciality', 'specialist');
            $table->renameColumn('phd_speciality', 'phd');
        });
    }
};
