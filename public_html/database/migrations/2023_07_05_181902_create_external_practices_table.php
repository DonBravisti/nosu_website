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
        Schema::create('external_practices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empl_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('organization', 255);
            $table->string('position', 255);
            $table->tinyInteger('education');
            $table->timestamps();

            $table->foreign('empl_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_practices');
    }
};
