<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\centrocm_jornada_servicio_noatiende;
use App\Tmodulo_Referencia;
use App\tservicio_referencia;
use App\centrocm_jornada;
use App\centrocm_jornada_servicio;
use App\centrocm_jornada_servicio_turno;
use App\centrocm_servicio_prestadora;
use App\centrocmjornada_noatiende;
use App\Cita_Agendamiento;
use App\tprestadora;
use App\tcentrocm;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Carbon\Carbon;


class CentrocmJornadaServicioNoatiendeController extends Controller
{
    public function store(Request $request){
        str_replace(' ', '',$request['textHoraInicio']);

        $id_servicio_referencia     = $request['comboListaServicios']; //
        $fechaNoAtiende             = $request['fechaNoAtiende'];
        $textHoraInicioNoAtiende    = $request['textHoraInicioNoAtiende'];
        $textHoraTerminoNoAtiende   = $request['textHoraTerminoNoAtiende'];
        $observaciones              = $request['textObservacionesnoAtiende'];

        $dia_string   = substr($fechaNoAtiende,6,4).substr($fechaNoAtiende,3,2).substr($fechaNoAtiende,0,2);

        $week= ['Monday'    =>'lunes',
                'Tuesday'   =>'martes',
                'Wednesday' =>'miércoles',
                'Thursday'  =>'jueves',
                'Friday'    =>'viernes',
                'Saturday'  =>'sábado',
                'Sunday'    =>'domingo'];

        $dia_compuesto= substr($fechaNoAtiende,6,4).'-'.substr($fechaNoAtiende,3,2).'-'.substr($fechaNoAtiende,0,2);
        $dia_carbon   = Carbon::createFromFormat('Y-m-d',$dia_compuesto );
        $dia_ingles   = $dia_carbon->format('l');
        $dia_espaniol = $week[$dia_ingles];
        $dia_string   = $dia_compuesto= substr($fechaNoAtiende,6,4).substr($fechaNoAtiende,3,2).substr($fechaNoAtiende,0,2);
        $dia_int      = intval($dia_string);


        $id_centrocm_jornada_servicio = null;

        $modulosdisponibles= DB::table('centrocm_jornada_servicio')->join('centrocm_jornada','centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')->where('centrocm_jornada_servicio.id_servicio_referencia',$id_servicio_referencia)->where('centrocm_jornada.cjdia',$dia_espaniol)->get();

        $form_hora_inicio   = strtotime($textHoraInicioNoAtiende);
        $form_hora_termino  = strtotime($textHoraTerminoNoAtiende);

        foreach ($modulosdisponibles as $item) {

                $db_hora_inicio     = strtotime($item->cjhora_inicio);
                $db_hora_termino    = strtotime($item->cjhora_termino);

                if (($item->id_servicio_referencia == $id_servicio_referencia) &&
                    ($item->cjdia == $dia_espaniol) &&
                    ($db_hora_inicio <= $form_hora_inicio ) &&
                    ($db_hora_termino >= $form_hora_termino) ){

                    $id_centrocm_jornada_servicio = $item->id_centrocm_jornada_servicio;

                }
        }

        $new = centrocm_jornada_servicio_noatiende::create (array('id_centrocm_jornada_servicio'=>$id_centrocm_jornada_servicio,'cjsnafecha'=> $dia_int,'cjsnahora_inicio'  =>$textHoraInicioNoAtiende,
                                                                  'cjsnahora_termino' => $textHoraTerminoNoAtiende,'cjsnaobservaciones'=> $observaciones));
        print ($new);

        return back()->with('success','Se ha registrado la fecha y hora indicada, correctamente');
    }

    public function destroy($id){

        $registro= centrocm_jornada_servicio_noatiende::find($id);

            $registro->delete();

            return back()->with('success','Se ha eliminado el servicio indicado, correctamente');

    }

}
