<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidato', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("estudiante_id")->unique();
            $table->foreign("estudiante_id")->references("id")->on("estudiantes");
            $table->unsignedBigInteger("cargo_id");
            $table->unsignedBigInteger("tarjeton_id");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidato');
    }
};