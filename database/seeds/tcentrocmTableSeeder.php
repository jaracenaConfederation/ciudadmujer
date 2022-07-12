<?php

use Illuminate\Database\Seeder;
use App\tcentrocm;

class tcentrocmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tcentrocm::create(array('n_centrocm'=>'Coquimbo'));

        tcentrocm::create(array('n_centrocm'=>'La Serena'));

        tcentrocm::create(array('n_centrocm'=>'Ovalle'));

    }
}
