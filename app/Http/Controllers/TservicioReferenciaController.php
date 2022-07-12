<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tservicio_referencia;

class TservicioReferenciaController extends Controller
{
    public function listado($option){

       $listaservicio= tservicio_referencia::where(['id_modulo_referencia'=>$option])->get(['id_servicio_referencia','n_servicio_referencia']);

       return ($listaservicio);


    }
}
