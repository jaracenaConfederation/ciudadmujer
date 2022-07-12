<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_usuaria extends Model
{
    protected $table='registro_usuaria';
    protected $primaryKey='id_cm';
    protected $fillable=[
        'numero_identificacion',
        'id_tipo_identificacion',
        'nombres',
        'apellidos',
        'alias',
        'id_origen_etnico',
        'fecha_nacimiento',
        'id_estado_civil',
        'ultima_visita_medico',
        'presenta_discapacidad',
        'diacapacidad',
        'estudia_actualmente',
        'id_escolaridad',
        'trabaja_actualmente',
        'telefono1',
        'movil1',
        'movil2',
        'telefono_contacto',
        'disponibilidad_tiempo',
        'horarios',
        'email',
        'id_user_registro',
        'fecha_registro',
        ];
    public $timestamps=false;

}
