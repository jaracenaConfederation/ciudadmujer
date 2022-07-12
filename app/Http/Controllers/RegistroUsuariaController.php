<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro_usuaria;
use App\Tmodulo_Referencia;
use App\Cita_Agendamiento;

class RegistroUsuariaController extends Controller
{

    public function show($request)
    {
        $id_cm= $request;
        $registrousuaria[0]=null;

        $registrousuaria=Registro_usuaria::where(['id_cm'=>$id_cm])->get(['numero_identificacion','nombres','apellidos','fecha_nacimiento']);

        return ($registrousuaria);


    }

    public function showidcm($request)
    {
        $numident= $request;
        $idcm[0]=null;

        $idcm=Registro_usuaria::where(['numero_identificacion'=>$numident])->get(['id_cm']);

        return ($idcm);


    }

}
