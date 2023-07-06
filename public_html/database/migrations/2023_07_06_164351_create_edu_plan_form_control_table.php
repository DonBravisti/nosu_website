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
        Schema::create('edu_plan_form_control', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edu_semester_id');
            $table->unsignedBigInteger('form_control_id');
            $table->timestamps();

            $table->foreign('edu_semester_id')->references('id')->on('edu_semesters');
            $table->foreign('form_control_id')->references('id')->on('form_control');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_plan_form_control');
    }
};
