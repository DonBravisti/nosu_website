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
        Schema::create('empl_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empl_id');
            $table->unsignedBigInteger('publ_id');
            $table->timestamps();

            $table->foreign('empl_id')->references('id')->on('employees');
            $table->foreign('publ_id')->references('id')->on('publications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empl_publications');
    }
};
