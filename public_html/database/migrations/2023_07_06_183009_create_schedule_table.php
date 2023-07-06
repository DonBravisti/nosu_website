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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id');
            $table->integer('subgroup_num');
            $table->foreignId('edu_semester_id');
            $table->foreignId('subject_form_id');
            $table->foreignId('employee_id');
            $table->year('current_year');
            $table->integer('semester');
            $table->integer('day_week');
            $table->integer('lesson_num');
            $table->integer('week_num');
            $table->unsignedBigInteger('croom_id');
            $table->timestamps();

            $table->foreign('croom_id')->references('id')->on('classrooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
