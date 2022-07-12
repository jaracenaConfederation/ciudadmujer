<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CitaAgendamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_agendamiento', function (Blueprint $table){
            $table->increments('id_cita');
            $table->bigInteger('id_cm');
            $table->integer('id_centrocm_servicio_prestadora');
            $table->integer('id_estado_cita');
            $table->date('fecha_cita');
            $table->time('hora_inicio_cita',5);
            $table->time('hora_termino_cita',5);
            $table->text('observaciones');
            $table->string('solicitantes');
            $table->time('hora_atencion_inicio',5);
            $table->time('hora_atencion_termino',5);
            $table->string('id_user_registro');
            $table->integer('fecha_registro');
            $table->timestamps();

            $table->foreign('id_cm')->references('id_cm')->on('registro_usuaria');
            $table->foreign('id_centrocm_servicio_prestadora')->references('id_centrocm_servicio_prestadora')->on('centrocm_servicio_prestadora');
            $table->foreign('id_estado_cita')->references('id_estado_cita')->on('testado_cita');





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita_agendamiento');
    }
}
