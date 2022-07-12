<?php

use Illuminate\Database\Seeder;
use App\centrocmjornada;

class centrocmjornadaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['id_centrocm'=>'1','n_jornada'=>'mañana'  ,'cjdia'=>'lunes' ,    'cjhora_inicio'=>'8:00' ,'cjhora_termino'=>'12:00'],
            ['id_centrocm'=>'1','n_jornada'=>'tarde'   ,'cjdia'=>'lunes' ,    'cjhora_inicio'=>'13:00','cjhora_termino'=>'16:00'],
            ['id_centrocm'=>'1','n_jornada'=>'mañana'  ,'cjdia'=>'martes' ,   'cjhora_inicio'=>'8:00' ,'cjhora_termino'=>'12:00'],
            ['id_centrocm'=>'1','n_jornada'=>'tarde'   ,'cjdia'=>'martes' ,   'cjhora_inicio'=>'13:00','cjhora_termino'=>'16:00'],
            ['id_centrocm'=>'1','n_jornada'=>'mañana'  ,'cjdia'=>'miercoles' ,'cjhora_inicio'=>'8:00' ,'cjhora_termino'=>'12:00'],
            ['id_centrocm'=>'1','n_jornada'=>'tarde'   ,'cjdia'=>'miercoles' ,'cjhora_inicio'=>'13:00','cjhora_termino'=>'16:00'],
            ['id_centrocm'=>'1','n_jornada'=>'mañana'  ,'cjdia'=>'jueves' ,   'cjhora_inicio'=>'8:00' ,'cjhora_termino'=>'12:00'],
            ['id_centrocm'=>'1','n_jornada'=>'tarde'   ,'cjdia'=>'jueves' ,   'cjhora_inicio'=>'13:00','cjhora_termino'=>'16:00'],
            ['id_centrocm'=>'1','n_jornada'=>'mañana'  ,'cjdia'=>'viernes' ,  'cjhora_inicio'=>'8:00' ,'cjhora_termino'=>'12:00'],
            ['id_centrocm'=>'1','n_jornada'=>'tarde'   ,'cjdia'=>'viernes' ,  'cjhora_inicio'=>'13:00','cjhora_termino'=>'16:00'],
        ];

        foreach ($data as $key => $value) {

            centrocmjornada::create($value);

        }
    }
}
