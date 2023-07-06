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
        Schema::create('empl_loads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('load_id')->constrained();
            $table->integer('semester');
            $table->foreignId('employee_id')->constrained();
            $table->tinyInteger('hourly_fund');
            $table->foreignId('edu_semester_id')->constrained();
            $table->string('subject', 255);
            $table->foreignId('group_id')->constrained();
            $table->foreignId('subject_form_id')->constrained();
            $table->decimal('hours_other', 10, 2);
            $table->decimal('hours_contact', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empl_loads');
    }
};
