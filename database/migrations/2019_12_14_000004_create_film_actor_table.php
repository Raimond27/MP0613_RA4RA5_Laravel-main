<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    
    // public function up(): void
    // {
    //     Schema::create('film_actor', function (Blueprint $table) {
    //         // Crea la columna y la relación en una sola línea
    //         $table->foreignId('film_id')
    //               ->constrained() // Detecta que la tabla es 'films'
    //               ->onDelete('cascade');

    //         $table->foreignId('actor_id')
    //               ->constrained() // Detecta que la tabla es 'actors'
    //               ->onDelete('cascade');

    //         $table->timestamps();

    //         // Definimos la llave primaria compuesta
    //         $table->primary(['film_id', 'actor_id']);
    //     });
    // }

    // /**
    //  * Revierte la migración.
    //  */
    // public function down(): void
    // {
    //     // Al borrar la tabla, las llaves foráneas se eliminan automáticamente
    //     Schema::dropIfExists('film_actor');
    // }

     public function up(): void

    {

        Schema::create('film_actor', function (Blueprint $table) {

            $table->unsignedBigInteger('film_id');

            $table->unsignedBigInteger('actor_id');

            $table->timestamps();



            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');

            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');



            $table->primary(['film_id', 'actor_id']);

        });

    }



    /**

     * Reverse the migrations.

     */

    public function down(): void

    {

        Schema::dropIfExists('film_actor');

    }
};
