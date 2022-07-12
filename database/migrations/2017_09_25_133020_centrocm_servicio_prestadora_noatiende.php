<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmServicioPrestadoraNoatiende extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_servicio_prestadora_noatiende',function(Blueprint $table){
            $table->increments('id_centrocm_servicio_prestadora_noatiende');
            $table->integer('id_centrocm_servicio_prestadora');
            $table->integer('cspnafecha');
            $table->time('cspnahora_inicio');
            $table->time('cspnahora_termino');
            $table->text('cspnaobservaciones');

            $table->foreign('id_centrocm_servicio_prestadora')->references('id_centrocm_servicio_prestadora')->on('centrocm_servicio_prestadora');

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
        Schema::dropIfExists('centrocm_servicio_prestadora_noatiende');
    }
}
