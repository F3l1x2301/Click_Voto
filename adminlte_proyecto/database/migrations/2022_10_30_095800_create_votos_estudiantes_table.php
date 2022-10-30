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
        Schema::create('votos_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("candidatos_id");
            $table->foreign("candidatos_id")->references("id")->on("candidatos");

            $table->unsignedBigInteger("cursos_id");
            $table->foreign("cursos_id")->references("id")->on("cursos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votos_estudiantes');
    }
};
