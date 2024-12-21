<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEducationLevelsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('bachelor')->nullable()->after('qualification'); // Бакалавриат
            $table->string('master')->nullable()->after('bachelor'); // Магистратура
            $table->string('specialist')->nullable()->after('master'); // Специалитет
            $table->string('phd')->nullable()->after('specialist'); // Аспирантура
            $table->string('doctorate')->nullable()->after('phd'); // Докторантура
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['bachelor', 'master', 'specialist', 'postgraduate', 'doctorate']);
        });
    }
}
