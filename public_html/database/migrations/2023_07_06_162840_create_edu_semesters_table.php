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
        Schema::create('edu_semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edu_plan_id');
            $table->integer('semester');
            $table->decimal('zed', 10, 2);
            $table->integer('lecture');
            $table->integer('practice');
            $table->integer('laboratory');
            $table->integer('ind_work');
            $table->timestamps();

            $table->foreign('edu_plan_id')->references('id')->on('edu_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_semesters');
    }
};
