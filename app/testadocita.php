<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testadocita extends Model
{
    protected $table='testado_cita';
    protected $primaryKey='id_estado_cita';
    protected $fillable=['n_estado_cita'];

}
