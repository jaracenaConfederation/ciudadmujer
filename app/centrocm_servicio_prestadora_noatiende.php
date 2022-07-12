<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class centrocm_servicio_prestadora_noatiende extends Model
{
    protected $table='centrocm_servicio_prestadora_noatiende';
    protected $primaryKey='id_centrocm_servicio_prestadora_noatiende';
    protected $fillable=['id_centrocm_servicio_prestadora','cspnafecha','cspnahora_inicio','cspnahora_termino','cspnaobservaciones'];
}
