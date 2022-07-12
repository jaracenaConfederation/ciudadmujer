<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmJornadaServicioNoatiende extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_jornada_servicio_noatiende', function (Blueprint $table) {
            $table->increments('id_centrocm_jornada_servicio_noatiende');
            $table->integer('id_centrocm_jornada_servicio');
            $table->integer('cjsnafecha');
            $table->time('cjsnahora_inicio');
            $table->time('cjsnahora_termino');
            $table->string('cjsnaobservaciones');

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
        Schema::dropIfExists('centrocm_jornada_servicio_noatiende');
    }
}
