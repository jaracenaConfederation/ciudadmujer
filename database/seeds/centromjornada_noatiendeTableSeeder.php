<?php

use Illuminate\Database\Seeder;
use App\centrocmjornada_noatiende;

class centromjornada_noatiendeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['id_centrocm_jornada'=>2,'cjnafecha'=>20170916  ,'cjnahora_inicio'=>'14:00','cjnahora_termino'=>'16:00','cjnaobservaciones'=>'Por salida temprano previa fiestas patrias'],
            ['id_centrocm_jornada'=>4,'cjnafecha'=>20170916  ,'cjnahora_inicio'=>'14:00','cjnahora_termino'=>'16:00','cjnaobservaciones'=>'Por salida temprano previa fiestas patrias'],
            ['id_centrocm_jornada'=>5,'cjnafecha'=>20170916  ,'cjnahora_inicio'=>'14:00','cjnahora_termino'=>'16:00','cjnaobservaciones'=>'Por salida temprano previa fiestas patrias'],

        ];


        foreach ($data as $key => $value) {

            centrocmjornada_noatiende::create($value);

        }
    }
}
