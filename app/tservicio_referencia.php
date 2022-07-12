<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class tservicio_referencia extends Model
{
    protected $table='tservicio_referencia';
    protected $primaryKey='id_servicio_referencia';
    protected $fillable= [
        'id_modulo_referencia ',
        'n_modulo_referencia',
        'codigo_grupo',
        'visible_referencia',
        'disponible_cita'
        ];
}
