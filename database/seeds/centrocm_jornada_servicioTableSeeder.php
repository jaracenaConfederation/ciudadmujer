<?php

use Illuminate\Database\Seeder;
use App\centrocm_jornada_servicio;

class centrocm_jornada_servicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
//          Este es el servicio MSSR 101 Medicina General atiende todas las mañanas entre las 10:00 y las 12:00
/* Mañana*/['id_servicio_referencia'=>101,'id_centrocm_jornada'=>1  ,'cjshora_inicio'=>'10:00','cjshora_termino'=>'12:00'],
/* Mañana*/['id_servicio_referencia'=>101,'id_centrocm_jornada'=>3  ,'cjshora_inicio'=>'10:00','cjshora_termino'=>'12:00'],
/* Mañana*/['id_servicio_referencia'=>101,'id_centrocm_jornada'=>5  ,'cjshora_inicio'=>'10:00','cjshora_termino'=>'12:00'],
/* Mañana*/['id_servicio_referencia'=>101,'id_centrocm_jornada'=>7  ,'cjshora_inicio'=>'10:00','cjshora_termino'=>'12:00'],
/* Mañana*/['id_servicio_referencia'=>101,'id_centrocm_jornada'=>9  ,'cjshora_inicio'=>'10:00','cjshora_termino'=>'12:00'],

//          Este es el servicio MSSR 111 Radiografia que atiende de lunes a viernes oscilando de tarde a mañana
/* Tarde*/  ['id_servicio_referencia'=>111,'id_centrocm_jornada'=>2  ,'cjshora_inicio'=>'13:00' ,'cjshora_termino'=>'16:00'],
/* Mañana*/ ['id_servicio_referencia'=>111,'id_centrocm_jornada'=>3  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>111,'id_centrocm_jornada'=>6  ,'cjshora_inicio'=>'13:00' ,'cjshora_termino'=>'16:00'],
/* Mañana*/ ['id_servicio_referencia'=>111,'id_centrocm_jornada'=>7  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>111,'id_centrocm_jornada'=>10  ,'cjshora_inicio'=>'13:00' ,'cjshora_termino'=>'16:00'],


//          Este es el servicio  MVC 203 Atención Social que atiende de lunes a viernes en las tardes
/* Tarde*/  ['id_servicio_referencia'=>203,'id_centrocm_jornada'=>2  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Tarde*/  ['id_servicio_referencia'=>203,'id_centrocm_jornada'=>4  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Tarde*/  ['id_servicio_referencia'=>203,'id_centrocm_jornada'=>6  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Tarde*/  ['id_servicio_referencia'=>203,'id_centrocm_jornada'=>8  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Tarde*/  ['id_servicio_referencia'=>203,'id_centrocm_jornada'=>10 ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],

//          Este es el servicio  MAA 303 Atención psicologica que atiende martes y jueves en la mañana
/* Mañana*/ ['id_servicio_referencia'=>303,'id_centrocm_jornada'=>3,'cjshora_inicio'=>'9:30' ,'cjshora_termino'=>'12:00'],
/* Mañana*/ ['id_servicio_referencia'=>303,'id_centrocm_jornada'=>7,'cjshora_inicio'=>'9:30' ,'cjshora_termino'=>'12:00'],

//          Este es el servicio 401 Orientación laboral y promoción del empleo que atiende de lunes a viernes de mañana y tarde
/* Mañana*/ ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>1  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>2  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Mañana*/ ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>3  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>4  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Mañana*/ ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>5  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>6  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Mañana*/ ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>7  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>8  ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],
/* Mañana*/ ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>9  ,'cjshora_inicio'=>'8:00' ,'cjshora_termino'=>'12:00'],
/* Tarde*/  ['id_servicio_referencia'=>401,'id_centrocm_jornada'=>10 ,'cjshora_inicio'=>'13:00','cjshora_termino'=>'16:00'],

        ];

        foreach ($data as $key => $value) {

            centrocm_jornada_servicio::create($value);

        }
    }
}
