<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicadores extends Model
{
    protected $primaryKey = "id_indicador";
    protected $table = "indicador";
    protected $fillable = ['id_modulo_referencia','id_indicador_unidad','id_indicador_estado','nombre_indicador','etiqueta_indicador','descripcion','formula_calculo','id_usuario','fecha_registro'];
    public $timestamps = false;

    public function indicador_estado()
    {
        return $this->belongsto('App\Indicador_Estado','id_indicador_estado');
    }

    public function indicador_unidad()
    {
        return $this->belongsto('App\Indicador_Unidad', 'id_indicador_unidad');
    }

    public function treferencia_modulo()
    {
        return $this->belongsto('App\Tmodulo_Referencia', 'id_modulo_referencia');
    }

}
