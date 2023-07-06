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
        Schema::create('empl_loads_streams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empl_loads_id1');
            $table->unsignedBigInteger('empl_loads_id2');
            $table->timestamps();

            $table->foreign('empl_loads_id1')->references('id')->on('empl_loads');
            $table->foreign('empl_loads_id2')->references('id')->on('empl_loads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empl_loads_streams');
    }
};
