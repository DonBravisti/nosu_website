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
        Schema::create('thesis_work', function (Blueprint $table) {
            $table->id();
            $table->year('current_year');
            $table->integer('semester');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('employee_id')->constrained();
            $table->string('title', 255);
            // $table->unsignedBigInteger('thesis_work_type_id');
            $table->foreignId('thesis_work_type_id')->constrained();
            $table->integer('mark');
            $table->timestamps();

            // $table->foreign('thesis_work_type_id')->references('id')->on('thesis_work_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_work');
    }
};
