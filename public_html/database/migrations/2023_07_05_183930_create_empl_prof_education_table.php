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
        Schema::create('empl_prof_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->string('number', 30);
            $table->date('date');
            $table->unsignedBigInteger('doc_type_id');
            $table->string('title', 200);
            $table->integer('n_hours');
            $table->string('organization', 255);
            $table->timestamps();

            $table->foreign('doc_type_id')->references('id')->on('prof_doc_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empl_prof_education');
    }
};
