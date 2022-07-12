<?php

use Illuminate\Database\Seeder;
use App\Tmodulo_Referencia;

class tmodulo_referenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['n_modulo_referencia'=>'MSSR'],
            ['n_modulo_referencia'=>'MVCM'],
            ['n_modulo_referencia'=>'MAA'],
            ['n_modulo_referencia'=>'MAE'],
            ['n_modulo_referencia'=>'MEC'],
            ['n_modulo_referencia'=>'Referencia Externa'],
        ];
        foreach ($data as $key => $value) {

            Tmodulo_Referencia::create($value);

        }
    }
}
