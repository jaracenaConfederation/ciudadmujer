<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Registro_Taller extends Model
{
    protected $primaryKey="id_registro_taller";
    protected $table="registro_taller";
    protected $fillable=['n_registro_taller','id_modulo_referencia','activo'];
    public $timestamps = false;

    public function tmodulo_referencia()
    {
        return $this->belongsTo('App\Tmodulo_Referencia','id_modulo_referencia');
    }

}
