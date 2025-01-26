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
        Schema::table('empl_contracts', function (Blueprint $table) {
            $table->decimal('rate', 5, 2)->default(1.00)->after('department_id')->comment('Ставка сотрудника');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('empl_contracts', function (Blueprint $table) {
            $table->dropColumn('rate');
        });
    }
};
