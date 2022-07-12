<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class centrocmjornada_noatiende extends Model
{
    protected $table="centrocm_jornada_noatiende";
    protected $primaryKey='id_centrocm_jornada_noatiende';
    protected $fillable= ['id_centrocm_jornada','cjnafecha','cjnahora_inicio','cjnahora_termino','observaciones'];

    public function centrocmjornada()
    {
        return $this->belongsTo('App\centrocmjornada','id_centrocm_jornada');
    }

}
