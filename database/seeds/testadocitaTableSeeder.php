<?php

use Illuminate\Database\Seeder;
use App\testadocita;

class testadocitaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['n_estado_cita'=>'Disponible'],
            ['n_estado_cita'=>'Asignada'],
            ['n_estado_cita'=>'Reservada'],
            ['n_estado_cita'=>'Cambiada'],
            ['n_estado_cita'=>'No Asistio'],
            ['n_estado_cita'=>'Atendida'],
            ['n_estado_cita'=>'No Atendida'],
            ['n_estado_cita'=>'Cancelada'],
        ];


        foreach ($data as $key => $value) {

            testadocita::create($value);

        }
    }
}
