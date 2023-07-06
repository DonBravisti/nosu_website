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
        Schema::create('title_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spec_id');
            $table->string('profile', 255);
            $table->date('date_uchsovet');
            $table->integer('number_uchsovet');
            $table->year('current_year');
            $table->year('date_enter');
            $table->date('date_fgos');
            $table->integer('number_fgos');
            $table->foreignId('department_id')->constrained();
            $table->string('included', 1);
            $table->timestamps();

            $table->foreign('spec_id')->references('id')->on('speciality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('title_plan');
    }
};
