<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class centrocm_jornada_servicio_noatiende extends Model
{
    protected $table='centrocm_jornada_servicio_noatiende';
    protected $primaryKey='id_centrocm_jornada_servicio_noatiende';
    protected $fillable=['id_centrocm_jornada_servicio','cjsnafecha','cjsnahora_inicio','cjsnahora_termino','cjsnaobservaciones'];
}
