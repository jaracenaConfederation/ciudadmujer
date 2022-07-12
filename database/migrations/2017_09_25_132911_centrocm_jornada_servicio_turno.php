<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmJornadaServicioTurno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_jornada_servicio_turno', function (Blueprint $table) {
            $table->increments('id_centrocm_jornada_servicio_turno');
            $table->integer('id_centrocm_jornada_servicio');
            $table->string('id_turno',45);
            $table->time('cjsthora_inicio');
            $table->time('cjsthora_termino');

            $table->foreign('id_centrocm_jornada_servicio')->references('id_centrocm_jornada_servicio')->on('centrocm_jornada_servicio');

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
        Schema::dropIfExists('centrocm_jornada_servicio_turno');
    }
}
