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
        Schema::create('edu_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_id');
            $table->foreignId('subject_id')->constrained();
            $table->string('code_subject', 10);
            $table->foreignId('department_id')->constrained();
            $table->unsignedBigInteger('title_plan_id');
            $table->timestamps();

            $table->foreign('block_id')->references('id')->on('block');
            $table->foreign('title_plan_id')->references('id')->on('title_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_plan');
    }
};
