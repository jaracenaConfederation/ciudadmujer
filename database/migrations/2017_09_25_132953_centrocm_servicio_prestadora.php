<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmServicioPrestadora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_servicio_prestadora',function(Blueprint $table){
           $table->increments('id_centrocm_servicio_prestadora');
           $table->string('id_prestadora',20);
           $table->integer('id_centrocm_jornada_servicio');
           $table->time('csphora_inicio');
           $table->time('csphora_termino');
           $table->foreign('id_prestadora')->references('id_prestadora')->on('tprestadora');

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
        Schema::dropIfExists('centrocm_servicio_prestadora');
    }
}
