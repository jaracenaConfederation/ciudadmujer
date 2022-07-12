<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistroTaller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//       Schema::create('registro_taller',function(Blueprint $table){
//
//           $table->increments('id_registro_taller');
//           $table->string('n_registro_taller',75);
//           $table->integer('id_modulo_referencia');
//           $table->string('activo',1)->default('S');
//           $table->timestamps();
//           $table->foreign('id_modulo_referencia')->references('id_modulo_referencia')->on('tmodulo_referencia');
//
//       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('registro_taller');
    }
}
