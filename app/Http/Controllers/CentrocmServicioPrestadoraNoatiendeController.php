<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\centrocm_servicio_prestadora;
use App\centrocm_servicio_prestadora_noatiende;

class CentrocmServicioPrestadoraNoatiendeController extends Controller
{


    public function store(Request $request){

        $id_prestadora      = $request['comboListaPrestadoras'];
        $cspnafecha         = $request['cspnafecha'];
        $cspnahora_inicio   = $request['cspnahora_inicio'];
        $cspnahora_termino  = $request['cspnahora_termino'];
        $cspnaobservaciones = $request['cspnaobservaciones'];

        $cspnafecha_string  = substr($cspnafecha,6,4).substr($cspnafecha,3,2).substr($cspnafecha,0,2);

        $form_fecha_string  = substr($cspnafecha,0,2).'-'.substr($cspnafecha,3,2).'-'.substr($cspnafecha,6,4);


        //conversion de horas del formulario a strtotime

        $form_hora_inicio   = strtotime($cspnahora_inicio);//
        $form_hora_termino  = strtotime($cspnahora_termino);//


        //sergun fecha del formulario debemos detectar el día
        $week = [   'Monday'    =>'lunes',
            'Tuesday'   =>'martes',
            'Wednesday' =>'miércoles',
            'Thursday'  =>'jueves',
            'Friday'    =>'viernes',
            'Saturday'  =>'sábado',
            'Sunday'    =>'domingo'];
        $form_fecha_string  = Carbon::createFromFormat('d-m-Y', $form_fecha_string)->format('l');
        $form_dia_semana = $week[$form_fecha_string]; //

//        $idcprestadora = centrocm_servicio_prestadora::where('id_prestadora','=',$id_prestadora)->distinct('id_prestadora','id_centrocm_servicio_prestadora')->get(array('id_centrocm_servicio_prestadora'))->first();

        $todos_id_prestadoras= DB::table('centrocm_servicio_prestadora')
                                ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                                ->join('centrocm_jornada','centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')
                                ->where('id_prestadora','=',$id_prestadora)
                                ->where('cjdia','=',$form_dia_semana )

                                ->get();


        foreach ($todos_id_prestadoras as $t_id_prest){

            //conversion horas desde la BD

            $db_hora_inicio     =   strtotime($t_id_prest->cjhora_inicio);
            $db_hora_termino    =   strtotime($t_id_prest->cjhora_termino);


            if (    ($t_id_prest->cjdia == $form_dia_semana) && ($t_id_prest->id_prestadora == $id_prestadora )
                && ( $db_hora_inicio <= $form_hora_inicio ) && ($db_hora_termino >= $form_hora_termino)){


                $idcprestadora= $t_id_prest->id_centrocm_servicio_prestadora;

            }
        }




        $new = centrocm_servicio_prestadora_noatiende::create (array('id_centrocm_servicio_prestadora' => $idcprestadora,
            'cspnafecha'                    => $cspnafecha_string,
            'cspnahora_inicio'              => $cspnahora_inicio,
            'cspnahora_termino'             => $cspnahora_termino,
            'cspnaobservaciones'            => $cspnaobservaciones));

        return back()->with('success','La fecha de no atencion de la prestadora se ha guardado correctamente');
    }



    public function destroy(Request $request){

        $id_centrocm_servicio_prestadora_noatiende =$request['id_pres_noatiende'];

        $id_prest_noatiende = centrocm_servicio_prestadora_noatiende::find($id_centrocm_servicio_prestadora_noatiende);

        $id_prest_noatiende->delete();

        return back()->with('success','La fecha de no atencion se ha eliminado correctamente')->with('error','El turno no se ha podido eliminar');
    }

}
