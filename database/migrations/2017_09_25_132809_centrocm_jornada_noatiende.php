<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmJornadaNoatiende extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_jornada_noatiende', function (Blueprint $table) {
            $table->increments('id_centrocm_jornada_noatiende');
            $table->integer('id_centrocm_jornada');
            $table->integer('cjnafecha');
            $table->time('cjnahora_inicio');
            $table->time('cjnahora_termino');
            $table->string('cjnaobservaciones',45);
            $table->foreign('id_centrocm_jornada')->references('id_centrocm_jornada')->on('centrocm_jornada');

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
        Schema::dropIfExists('centrocm_jornada_noatiende');
    }
}
