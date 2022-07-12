<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador_Estado extends Model
{
    protected $primaryKey="id_indicador_estado";
    protected $table="indicador_estado";
    protected $fillable=['n_indicador_estado'];
    public $timestamps = false;
}
