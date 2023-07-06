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
        Schema::create('edu_plan_competencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edu_plan_id');
            $table->unsignedBigInteger('competency_id');
            $table->timestamps();

            $table->foreign('edu_plan_id')->references('id')->on('edu_plan');
            $table->foreign('competency_id')->references('id')->on('competence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_plan_competencies');
    }
};
