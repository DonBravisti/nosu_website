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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('surname', 30);
            $table->string('name', 30);
            $table->string('patronimyc', 100);
            $table->text('address');
            $table->date('birthdate');
            $table->TinyInteger('sex');
            $table->string('phone', 11);
            $table->string('email', 100);
            $table->string('base_education', 256);
            $table->text('orcid_url');
            $table->text('scopus_url');
            $table->text('mathnet_url');
            $table->text('clarivate_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
