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
        Schema::table('empl_contracts', function (Blueprint $table) {
            // Удаляем поле number
            $table->dropColumn('number');

            // Добавляем текстовое поле для места работы
            $table->string('workplace')->nullable()->after('date_to');

            // Добавляем поля для стажей
            $table->float('pedagogical_experience', 8, 2)->default(0)->after('workplace');
            $table->float('research_experience', 8, 2)->default(0)->after('pedagogical_experience');
            $table->float('other_experience', 8, 2)->default(0)->after('research_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empl_contracts', function (Blueprint $table) {
            // Добавляем поле number обратно
            $table->string('number')->nullable()->after('date_to');

            // Удаляем добавленные поля
            $table->dropColumn('workplace');
            $table->dropColumn('pedagogical_experience');
            $table->dropColumn('research_experience');
            $table->dropColumn('other_experience');
        });
    }
};
