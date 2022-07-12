<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToperariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toperaria', function (Blueprint $table) {
            $table->increments('id_operaria');
            $table->string('numero_identificacion')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('nombreusuaria')->unique();
            $table->string('password');
            $table->integer('id_centrocm');
            $table->rememberToken();
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
        Schema::dropIfExists('toperaria');
    }
}
