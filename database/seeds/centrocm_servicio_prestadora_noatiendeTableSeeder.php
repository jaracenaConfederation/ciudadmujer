<?php

use Illuminate\Database\Seeder;
use App\centrocm_servicio_prestadora_noatiende;

class centrocm_servicio_prestadora_noatiendeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['id_centrocm_servicio_prestadora'=>3,'cspnafecha'=>'20171010'  ,'cspnahora_inicio'=>'10:00','cspnahora_termino'=>'11:00','cspnaobservaciones'=>'Permiso Medico'],
            ['id_centrocm_servicio_prestadora'=>5,'cspnafecha'=>'20171015'  ,'cspnahora_inicio'=>'10:30','cspnahora_termino'=>'11:30','cspnaobservaciones'=>'Permiso Medico'],
            ];


        foreach ($data as $key => $value) {

            centrocm_servicio_prestadora_noatiende::create($value);

        }
    }
}
