<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class centrocm_jornada_servicio_turno extends Model
{
   protected $table='centrocm_jornada_servicio_turno';
   protected $primaryKey='id_centrocm_jornada_servicio_turno';
   protected $fillable=['id_centrocm_jornada_servicio','id_turno','cjsthora_inicio','cjsthora_termino'];
}
