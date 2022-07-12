<?php

use Illuminate\Database\Seeder;
use App\tprestadora;

class tprestadoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['id_prestadora'=>'jrojas'],
            ['id_prestadora'=>'pgomez'],
            ['id_prestadora'=>'rmerino'],
            ['id_prestadora'=>'tgutierrez'],
            ['id_prestadora'=>'ftapia'],
            ['id_prestadora'=>'bfica'],
            ['id_prestadora'=>'pvaldivia'],
            ['id_prestadora'=>'mrojas'],
            ['id_prestadora'=>'jarancibia'],
            ['id_prestadora'=>'dandrades'],
            ['id_prestadora'=>'pacuña'],
            ['id_prestadora'=>'cfabry'],
            ['id_prestadora'=>'respinoza'],
            ['id_prestadora'=>'ksotomayor'],
            ['id_prestadora'=>'labalos'],
        ];


        foreach ($data as $key => $value) {

            tprestadora::create($value);

        }
    }
}
