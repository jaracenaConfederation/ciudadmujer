<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmJornadaServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_jornada_servicio', function (Blueprint $table) {
            $table->increments('id_centrocm_jornada_servicio');
            $table->integer('id_servicio_referencia');
            $table->integer('id_centrocm_jornada');
            $table->time('cjshora_inicio');
            $table->time('cjshora_termino');

            $table->foreign('id_servicio_referencia')->references('id_servicio_referencia')->on('tservicio_referencia');
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
        Schema::dropIfExists('centrocm_jornada_servicio');
    }
}
