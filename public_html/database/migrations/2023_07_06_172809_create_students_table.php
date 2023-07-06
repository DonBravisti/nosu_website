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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronimyc', 50);
            $table->year('birth_year');
            $table->unsignedBigInteger('speciality_id');
            $table->year('date_enter');
            $table->foreignId('group_id')->constrained();
            $table->timestamps();

            $table->foreign('speciality_id')->references('id')->on('speciality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
