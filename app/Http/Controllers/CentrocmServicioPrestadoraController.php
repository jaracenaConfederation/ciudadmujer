<?php

namespace App\Http\Controllers;

use App\centrocm_jornada_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\tservicio_referencia;
use App\centrocm_jornada_servicio_noatiende;
use App\Tmodulo_Referencia;
use App\centrocm_jornada;
use App\centrocm_jornada_servicio_turno;
use App\centrocm_servicio_prestadora;
use App\centrocmjornada_noatiende;
use App\Cita_Agendamiento;
use App\tprestadora;
use App\tcentrocm;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Carbon\Carbon;

class CentrocmServicioPrestadoraController extends Controller
{

    public function index(){

        $pres = centrocm_servicio_prestadora::distinct('id_prestadora')->get(array('id_prestadora'));

        $prestadoras_disponibles = tprestadora::distinct('id_prestadora')->get(array('id_prestadora'));


        $listaprestadoras= DB::table('centrocm_servicio_prestadora')
            ->join('centrocm_jornada_servicio',
                'centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
            ->join('tservicio_referencia',
                'centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->join('centrocm_jornada',
                'centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')
            ->get();

        $listaprestadorasnoatiende= DB::table('centrocm_servicio_prestadora')->join('centrocm_servicio_prestadora_noatiende','centrocm_servicio_prestadora_noatiende.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')->get();

//        dd('$listaprestadorasnoatiende');

        $listaservicios = DB::table('centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
            ->join('centrocm_jornada','centrocm_jornada.id_centrocm_jornada','=','centrocm_jornada_servicio.id_centrocm_jornada')
            ->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')
            ->distinct('n_servicio_referencia')
            ->get(array('n_servicio_referencia','centrocm_jornada_servicio.id_servicio_referencia'));

        return view('magenda.agendaadmin_centrojornadaservicioprestadoras',compact('prestadoras_disponibles','listaprestadoras','pres','listaservicios','listaprestadorasnoatiende'));
    }

    public function store(Request $request){
        $id_prestadora                = $request['comboPrestadoras'];
        $id_centrocm_jornada_servicio = $request['comboDiasAtencion'];
        $hora_inicio                  = $request['textHoraInicio'];
        $hora_termino                 = $request['textHoraTermino'];
        $new = centrocm_servicio_prestadora::create (array('id_centrocm_jornada_servicio' => $id_centrocm_jornada_servicio,
            'id_prestadora'                => $id_prestadora,
            'csphora_inicio'              => $hora_inicio,
            'csphora_termino'             => $hora_termino));

        return back()->with('success','El turno se ha creado correctamente');
    }

    public function destroy(Request $request){

        $id_csprestadora = $request['id_csprestadora'];

        $prestadoras= centrocm_servicio_prestadora::find($id_csprestadora);
        $prestadoras->delete();

//        print ($id_centrocm_jornada_servicio);

        return back()->with('success','El turno se ha eliminado correctamente')->with('error','El turno no se ha podido eliminar');
    }




}
