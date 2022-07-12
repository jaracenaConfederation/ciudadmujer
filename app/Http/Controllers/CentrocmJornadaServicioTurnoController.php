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

class CentrocmJornadaServicioTurnoController extends Controller
{
    public function index(){
        $registroturnos= DB::table('centrocm_jornada_servicio')
            ->join('centrocm_jornada',
                'centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')
            ->join('centrocm_jornada_servicio_turno',
                'centrocm_jornada_servicio_turno.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->get();

        $listaservicios = DB::table('centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
            ->join('centrocm_jornada','centrocm_jornada.id_centrocm_jornada','=','centrocm_jornada_servicio.id_centrocm_jornada')
            ->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')
            ->distinct('n_servicio_referencia')
            ->get(array('n_servicio_referencia','centrocm_jornada_servicio.id_servicio_referencia'));



        return view('magenda.agendaadmin_centrojornadaservicioturno',compact('registroturnos','listaservicios'));
    }

    public function dias_atencion($id){

        $dia_atencion_servicios = DB::table('centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->join('centrocm_jornada','centrocm_jornada.id_centrocm_jornada','=','centrocm_jornada_servicio.id_centrocm_jornada')
            ->where('tservicio_referencia.id_servicio_referencia','=',$id)
            ->distinct('cjdia')
            ->get();
        return $dia_atencion_servicios;
    }

    public function dias_atencion_horas($id){

        $dia_atencion_servicios_horas = DB::table('centrocm_jornada_servicio')

            ->where('id_centrocm_jornada_servicio','=',$id)
            ->get();

        return $dia_atencion_servicios_horas;
    }
    public function store(Request $request){
        $id_centrocm_jornada_servicio= $request['comboDiasAtencion'];
        $id_turno                    = $request['nombreTurno'];
        $hora_inicio                 = $request['textHoraInicio'];
        $hora_termino                = $request['textHoraTermino'];

        $new = centrocm_jornada_servicio_turno::create (array('id_centrocm_jornada_servicio' => $id_centrocm_jornada_servicio,
                                                              'id_turno'                     => $id_turno,
                                                              'cjsthora_inicio'              => $hora_inicio,
                                                              'cjsthora_termino'             => $hora_termino));
        return back()->with('success','El turno se ha creado correctamente');
    }

    public function destroy(Request $request){

        $id_centrocm_jornada_servicio_turno=$request['id_centrocm_jornada_servicio_turno'];

        $turno = centrocm_jornada_servicio_turno::find($id_centrocm_jornada_servicio_turno);

        $turno->delete();

        return back()->with('success','El turno se ha eliminado correctamente')->with('error','El turno no se ha podido eliminar');
    }

}
