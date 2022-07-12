<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_Version extends Model
{
    protected $primaryKey="id_registro_version";
    protected $table="registro_version";
    protected $fillable=[   'n_registro_version','id_referengitcia_taller','tema_general',
                            'fecha_inicio','fecha_termino','cupos','activo','finalizado','institucion_responsable'];
    public $timestamps = false;

    public function registro_taller()
    {
        return $this->belongsTo('App\Registro_Taller', 'id_registro_taller');
    }
}
