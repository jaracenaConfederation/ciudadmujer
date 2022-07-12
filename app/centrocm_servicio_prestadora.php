<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class centrocm_servicio_prestadora extends Model
{
    protected $table='centrocm_servicio_prestadora';
    protected $primaryKey='id_centrocm_servicio_prestadora';
    protected $fillable=['id_prestadora','id_centrocm_jornada_servicio','csphora_inicio','csphora_termino'];

    public function centrocm_jornada_servicio()
    {

        return $this->belongsTo('App\centrocm_jornada_servicio','id_centrocm_jornada_servicio');
    }
}

