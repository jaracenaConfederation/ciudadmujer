<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador_Unidad extends Model
{
    protected $primaryKey="id_indicador_unidad";
    protected $table="indicador_unidad";
    protected $fillable=['n_indicador_unidad'];
    public $timestamps = false;
}
