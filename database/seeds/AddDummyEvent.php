<?php

use Illuminate\Database\Seeder;
use App\Event;
class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['title'=>'Rom Event', 'start_date'=>'2017-09-11' ,'start_time'=>'0800','end_date'=>'2017-09-11','end_time'=>'0830'],

            ['title'=>'Coyala Event', 'start_date'=>'2017-09-12','start_time'=>'0800', 'end_date'=>'2017-09-12','end_time'=>'0830'],

            ['title'=>'Lara Event', 'start_date'=>'2017-09-13','start_time'=>'0800', 'end_date'=>'2017-09-13','end_time'=>'0830'],

            ['title'=>'Otro Evento', 'start_date'=>'2017-09-11' ,'start_time'=>'1400','end_date'=>'2017-09-11','end_time'=>'1430'],

            ['title'=>'Rom Event', 'start_date'=>'2017-09-11' ,'start_time'=>'1430','end_date'=>'2017-09-11','end_time'=>'1500'],

            ['title'=>'Coyala Event', 'start_date'=>'2017-09-12','start_time'=>'1600', 'end_date'=>'2017-09-12','end_time'=>'1630'],

            ['title'=>'Lara Event', 'start_date'=>'2017-09-13','start_time'=>'1200', 'end_date'=>'2017-09-13','end_time'=>'1230'],

            ['title'=>'Otro Evento', 'start_date'=>'2017-09-11' ,'start_time'=>'1330','end_date'=>'2017-09-11','end_time'=>'1400'],

        ];


        foreach ($data as $key => $value) {

            Event::create($value);

        }
    }
}
