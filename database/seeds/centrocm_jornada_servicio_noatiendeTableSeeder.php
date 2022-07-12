<?php

use Illuminate\Database\Seeder;
use App\centrocm_jornada_servicio_noatiende;

class centrocm_jornada_servicio_noatiendeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [

            ['id_centrocm_jornada_servicio'=>1,'cjsnafecha'=>'20170920'  ,'cjsnahora_inicio'=>'10:00','cjsnahora_termino'=>'10:30','cjsnaobservaciones'=>'Reparacion Maquina Rx'],
            ['id_centrocm_jornada_servicio'=>1,'cjsnafecha'=>'20170920'  ,'cjsnahora_inicio'=>'10:30','cjsnahora_termino'=>'11:00','cjsnaobservaciones'=>'Reparacion Maquina Rx'],
        ];

        foreach ($data as $key => $value) {

            centrocm_jornada_servicio_noatiende::create($value);

        }


    }
}
