<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita_Agendamiento extends Model
{
    protected $table='cita_agendamiento';
    protected $primaryKey='id_cita';
    protected $fillable=[
                        'id_cm',
                        'id_centrocm_servicio_prestadora',
                        'id_estado_cita',
                        'fecha_cita',
                        'hora_inicio_cita',
                        'hora_termino_cita',
                        'observaciones',
                        'solicitantes',
                        'hora_atencion_inicio',
                        'hora_atencion_termino',
                        'id_user_registro',
                        'fecha_registro',

    ];
    public $timestamps= false;

    public function registrousuaria()
    {
        return $this->belongsTo('App\Registro_usuaria', 'id_cm');
    }
}


