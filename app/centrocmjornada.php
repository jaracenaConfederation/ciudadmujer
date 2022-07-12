<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class centrocmjornada extends Model
{
    protected $table="centrocm_jornada";
    protected $primaryKey='id_centrocm_jornada';
    protected $fillable= ['id_centrocm','n_jornada','cjdia','cjhora_inicio','cjhora_termino'];

    public function centrocm()
    {
        return $this->belongsTo('App\tcentrocm','id_centrocm');
    }
}
