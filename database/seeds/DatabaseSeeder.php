<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(tcentrocmTableSeeder::class);
        //$this->call(tservicio_referenciaTableSeeder::class);
        $this->call(testadocitaTableSeeder::class);
        $this->call(tprestadoraTableSeeder::class);
        $this->call(centrocmjornadaTableSeeder::class);
        $this->call(centromjornada_noatiendeTableSeeder::class);
        $this->call(centrocm_jornada_servicioTableSeeder::class);
        $this->call(centrocm_jornada_servicio_turnoTableSeeder::class);
        $this->call(centrocm_jornada_servicio_noatiendeTableSeeder::class);
        $this->call(centrocm_servicio_prestadoraTableSeeder::class);
        $this->call(centrocm_servicio_prestadora_noatiendeTableSeeder::class);
        $this->call(tmodulo_referenciaTableSeeder::class);
        $this->call(cita_agendamientoTableSeeder::class);
    }
}
