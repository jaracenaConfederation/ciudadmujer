<?php

use Illuminate\Database\Seeder;
use App\centrocm_servicio_prestadora;

class centrocm_servicio_prestadoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [

            ['id_prestadora'=>'jrojas'     ,'id_centrocm_jornada_servicio'=>1  ,'csphora_inicio'=>'10:30','csphora_termino'=>'11:30'],
            ['id_prestadora'=>'jrojas'     ,'id_centrocm_jornada_servicio'=>2  ,'csphora_inicio'=>'10:30','csphora_termino'=>'11:30'],
            ['id_prestadora'=>'jrojas'     ,'id_centrocm_jornada_servicio'=>3  ,'csphora_inicio'=>'10:30','csphora_termino'=>'11:30'],
            ['id_prestadora'=>'jrojas'     ,'id_centrocm_jornada_servicio'=>4  ,'csphora_inicio'=>'10:30','csphora_termino'=>'11:30'],
            ['id_prestadora'=>'jrojas'     ,'id_centrocm_jornada_servicio'=>5  ,'csphora_inicio'=>'10:30','csphora_termino'=>'11:30'],

            ['id_prestadora'=>'pgomez'     ,'id_centrocm_jornada_servicio'=>1  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'pgomez'     ,'id_centrocm_jornada_servicio'=>3  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'pgomez'     ,'id_centrocm_jornada_servicio'=>5  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],

            ['id_prestadora'=>'rmerino'     ,'id_centrocm_jornada_servicio'=>2  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'rmerino'     ,'id_centrocm_jornada_servicio'=>3  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'rmerino'     ,'id_centrocm_jornada_servicio'=>4  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],


            ['id_prestadora'=>'tgutierrez' ,'id_centrocm_jornada_servicio'=>6  ,'csphora_inicio'=>' 9:30','csphora_termino'=>'10:30'],
            ['id_prestadora'=>'tgutierrez' ,'id_centrocm_jornada_servicio'=>7  ,'csphora_inicio'=>' 9:30','csphora_termino'=>'10:30'],
            ['id_prestadora'=>'tgutierrez' ,'id_centrocm_jornada_servicio'=>8  ,'csphora_inicio'=>' 9:30','csphora_termino'=>'10:30'],
            ['id_prestadora'=>'tgutierrez' ,'id_centrocm_jornada_servicio'=>9  ,'csphora_inicio'=>' 9:30','csphora_termino'=>'10:30'],
            ['id_prestadora'=>'tgutierrez' ,'id_centrocm_jornada_servicio'=>10  ,'csphora_inicio'=>' 9:30','csphora_termino'=>'10:30'],

            ['id_prestadora'=>'ftapia'     ,'id_centrocm_jornada_servicio'=>6  ,'csphora_inicio'=>'15:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'ftapia'     ,'id_centrocm_jornada_servicio'=>8  ,'csphora_inicio'=>'15:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'ftapia'     ,'id_centrocm_jornada_servicio'=>10 ,'csphora_inicio'=>'15:00','csphora_termino'=>'16:00'],

            ['id_prestadora'=>'bfica'      ,'id_centrocm_jornada_servicio'=>11  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'bfica'      ,'id_centrocm_jornada_servicio'=>12  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'bfica'      ,'id_centrocm_jornada_servicio'=>13  ,'csphora_inicio'=>'13:00','csphora_termino'=>'14:00'],
            ['id_prestadora'=>'bfica'      ,'id_centrocm_jornada_servicio'=>14  ,'csphora_inicio'=>'14:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'bfica'      ,'id_centrocm_jornada_servicio'=>15  ,'csphora_inicio'=>'14:00','csphora_termino'=>'16:00'],

            ['id_prestadora'=>'pvaldivia'      ,'id_centrocm_jornada_servicio'=>11  ,'csphora_inicio'=>'13:00','csphora_termino'=>'15:00'],
            ['id_prestadora'=>'pvaldivia'      ,'id_centrocm_jornada_servicio'=>12  ,'csphora_inicio'=>'13:00','csphora_termino'=>'15:00'],
            ['id_prestadora'=>'pvaldivia'      ,'id_centrocm_jornada_servicio'=>13  ,'csphora_inicio'=>'13:00','csphora_termino'=>'15:00'],
            ['id_prestadora'=>'pvaldivia'      ,'id_centrocm_jornada_servicio'=>14  ,'csphora_inicio'=>'14:00','csphora_termino'=>'15:00'],
            ['id_prestadora'=>'pvaldivia'      ,'id_centrocm_jornada_servicio'=>15  ,'csphora_inicio'=>'14:00','csphora_termino'=>'15:00'],

            ['id_prestadora'=>'mrojas'      ,'id_centrocm_jornada_servicio'=>11  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'mrojas'      ,'id_centrocm_jornada_servicio'=>12  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'mrojas'      ,'id_centrocm_jornada_servicio'=>13  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'mrojas'      ,'id_centrocm_jornada_servicio'=>14  ,'csphora_inicio'=>'14:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'mrojas'      ,'id_centrocm_jornada_servicio'=>15  ,'csphora_inicio'=>'14:00','csphora_termino'=>'16:00'],

            ['id_prestadora'=>'jarancibia' ,'id_centrocm_jornada_servicio'=>16  ,'csphora_inicio'=>'9:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'jarancibia' ,'id_centrocm_jornada_servicio'=>17  ,'csphora_inicio'=>'9:00','csphora_termino'=>'12:00'],

            ['id_prestadora'=>'dandrades' ,'id_centrocm_jornada_servicio'=>16  ,'csphora_inicio'=>'9:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'dandrades' ,'id_centrocm_jornada_servicio'=>17  ,'csphora_inicio'=>'9:00','csphora_termino'=>'12:00'],

            ['id_prestadora'=>'pacuña' ,'id_centrocm_jornada_servicio'=>16  ,'csphora_inicio'=>'9:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'pacuña' ,'id_centrocm_jornada_servicio'=>17  ,'csphora_inicio'=>'9:00','csphora_termino'=>'12:00'],

            ['id_prestadora'=>'cfabry' ,'id_centrocm_jornada_servicio'=>16  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'cfabry' ,'id_centrocm_jornada_servicio'=>17  ,'csphora_inicio'=>'10:00','csphora_termino'=>'12:00'],


            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>18  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>19  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>20  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>21  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>22  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>23  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>18  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>19  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>20  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>21  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>22  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>23  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>24  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>25  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>26  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'respinoza' ,'id_centrocm_jornada_servicio'=>27  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],

            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>18  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>19  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>20  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>21  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>22  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>23  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>24  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>25  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>26  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'ksotomayor' ,'id_centrocm_jornada_servicio'=>27  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],

            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>18  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>19  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>20  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>21  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>22  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>23  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>24  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>25  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>26  ,'csphora_inicio'=>'8:00','csphora_termino'=>'12:00'],
            ['id_prestadora'=>'labalos' ,'id_centrocm_jornada_servicio'=>27  ,'csphora_inicio'=>'13:00','csphora_termino'=>'16:00'],






        ];






        foreach ($data as $key => $value) {

            centrocm_servicio_prestadora::create($value);

        }
    }
}
