<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentrocmJornada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrocm_jornada', function (Blueprint $table) {
            $table->increments('id_centrocm_jornada');
            $table->integer('id_centrocm');
            $table->string('n_jornada',45);
            $table->string('cjdia');
            $table->time('cjhora_inicio');
            $table->time('cjhora_termino');
            $table->timestamps();

            $table->foreign('id_centrocm')->references('id_centrocm')->on('tcentrocm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centrocm_jornada');
    }
}
