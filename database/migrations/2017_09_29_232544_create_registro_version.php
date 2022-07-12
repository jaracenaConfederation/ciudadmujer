<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroVersion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_version', function (Blueprint $table){
            $table->bigInteger('id_registro_version');
            $table->primary('id_registro_version');
            $table->string('n_registro_version');
            $table->bigInteger('id_registro_taller');
            $table->text('tema_general');
            $table->integer('fecha_inicio');
            $table->integer('fecha_termino');
            $table->integer('cupos');
            $table->string('activo',1);
            $table->string('finalizado',1);
            $table->string('institucion_responsable',70);
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
        Schema::dropIfExists('registro_version');
    }
}
