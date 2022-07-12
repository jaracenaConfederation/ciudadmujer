<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class centrocm_jornada_servicio extends Model
{
    protected $table='centrocm_jornada_servicio';
    protected $primaryKey='id_centrocm_jornada_servicio';
    protected $fillable=['id_servicio_referencia','id_centrocm_jornada','cjshora_inicio','cjshora_termino'];

    public function tservicio_referencia()
    {
        return $this->belongsTo('App\tservicio_referencia','id_servicio_referencia');
    }
}
