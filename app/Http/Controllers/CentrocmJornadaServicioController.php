<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use Carbon\Carbon;
use App\centrocmjornada;


class CentrocmJornadaServicioController extends Controller
{

    public function index(){
        $modulosdisponibles = Tmodulo_Referencia::get();

        $jornada_servicio= centrocm_jornada_servicio::get();

        $centrocm= tcentrocm::get();

        $centrocmjornada = DB::table('centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
            ->join('centrocm_jornada','centrocm_jornada.id_centrocm_jornada','=','centrocm_jornada_servicio.id_centrocm_jornada')
            ->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')
            ->distinct('tcentrocm.n_centrocm')
            ->orderBy('n_servicio_referencia','cjdia','ASC')->get();

        $centrocmdiasatencion = DB::table('centrocm_jornada')
            ->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')
            ->distinct('cjdia')->get(array('cjdia'));

        $servicio_noatiende = DB::table('centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

            ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
            ->join('centrocm_jornada','centrocm_jornada.id_centrocm_jornada','=','centrocm_jornada_servicio.id_centrocm_jornada')
            ->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')
            ->distinct('n_servicio_referencia')
            ->get(array('n_servicio_referencia','centrocm_jornada_servicio.id_servicio_referencia'));

        $servicio_noatiende_lista = DB::table('centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

            ->join('centrocm_jornada','centrocm_jornada.id_centrocm_jornada','=','centrocm_jornada_servicio.id_centrocm_jornada')

            ->join('centrocm_jornada_servicio_noatiende','centrocm_jornada_servicio_noatiende.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

            ->get();


//        dd($servicio_noatiende_lista);

        return view('magenda.agendaadmin_centrojornadaservicio',compact('centrocmdiasatencion','modulosdisponibles','centrocm','centrocmjornada','servicio_noatiende','servicio_noatiende_lista'));
    }

    public function showservicios($idmodulo){

        $servicio = tservicio_referencia::where('id_modulo_referencia','=',$idmodulo)->get();
        return ($servicio);
    }

    public function showjornadas($nomdia){

        $centrocmjornadasatencion = DB::table('centrocm_jornada')->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')
            ->where('cjdia','=', $nomdia )
            ->get(array('id_centrocm_jornada','n_jornada'));

            return ($centrocmjornadasatencion);

    }
    public function showjornadasmananatarde($id_centrocm_jornada){

        $centrocmjornadasatencion = DB::table('centrocm_jornada')->join('tcentrocm','tcentrocm.id_centrocm','=','centrocm_jornada.id_centrocm')->where('centrocm_jornada.id_centrocm_jornada','=', $id_centrocm_jornada )->get();

        return ($centrocmjornadasatencion);
    }

    public function show(){

    }
    public function store(){

    }

    public function storeserviciojornadacentro(Request $request){
        $id_cm= $request['comboNombreCentro'];
        $id_sr= $request['comboServicios'];
        $new=null;

        $id_centrocm_jornada= $request['comboJornada'];
//        $id_centrocm_jornada  = $request['id_centrocm_jornada'];

        $SiNoHorarioCentro = $request['comboSiNoHorarioCentro'];
        $SiNoHorarioJornada= $request['combosinoJornada'];

        if ($id_cm !='0' && $id_sr !='0'){

            if ($SiNoHorarioCentro == "si"){

                $centrocmjornada = centrocmjornada::where('id_centrocm','=',$id_cm)
                    ->where('centrocm_jornada.id_centrocm','=',$id_cm)
                    ->get();

                foreach ($centrocmjornada as $key => $cj) {

                    $new = centrocm_jornada_servicio::create (array('id_servicio_referencia' => $id_sr,'id_centrocm_jornada' => $cj->id_centrocm_jornada,
                        'cjshora_inicio' => $cj->cjhora_inicio, 'cjshora_termino' =>$cj->cjhora_termino,
                    ));
                }
                return back()->with('success','El horario para el servicio se ha creado correctamente');


            }else{

                if ($SiNoHorarioJornada== "si"){

                    $centrocmjornada = centrocmjornada::where('id_centrocm','=',$id_cm)
                        ->where('centrocm_jornada.id_centrocm','=',$id_cm)
                        ->where('centrocm_jornada.id_centrocm_jornada','=', $id_centrocm_jornada)
                        ->get();

                    foreach ($centrocmjornada as $key => $cj) {
                        $new = centrocm_jornada_servicio::create (array('id_servicio_referencia' => $id_sr,'id_centrocm_jornada' => $id_centrocm_jornada,'cjshora_inicio' => $cj->cjhora_inicio,'cjshora_termino' =>$cj->cjhora_termino));

                    }
                    return back()->with('success','El horario para el servicio se ha creado correctamente');
                }
                else{

                    $h_inicio = str_replace(' ', '',$request['textHoraInicio']);
                    $h_termino = str_replace(' ', '',$request['textHoraTermino']);

                    $new = centrocm_jornada_servicio::create (array('id_servicio_referencia' => $id_sr,'id_centrocm_jornada' => $id_centrocm_jornada,'cjshora_inicio' => $h_inicio,'cjshora_termino' =>$h_termino));

                    return back()->with('success','El horario para el servicio se ha creado correctamente');
                }
            }
        }
        else{
            return back();
        }
    }

    public function storeserviciojornadacentroporjornada(Request $request){

        $id_cm= $request['comboNombreCentro'];
        $id_sr= $request['comboServicios'];
        $id_centrocm_jornada= $request['comboJornada'];
        $id_centrocm_jornada  = $request['id_centrocm_jornada'];

            $centrocmjornada = centrocmjornada::where('id_centrocm','=',$id_cm)
                ->where('centrocm_jornada.id_centrocm','=',$id_cm)
                ->where('centrocm_jornada.id_centrocm_jornada','=', $id_centrocm_jornada)
                ->get();

        foreach ($centrocmjornada as $key => $cj) {
                $new = centrocm_jornada_servicio::create (array('id_servicio_referencia' => $id_sr,'id_centrocm_jornada' => $id_centrocm_jornada,'cjshora_inicio' => $cj->cjhora_inicio,'cjshora_termino' =>$cj->cjhora_termino));

        }
            return back()->with('success','El horario para el servicio se ha creado correctamente');
    }

    public function update(){

    }

    public function destroy( $id){

        $ccmjs = centrocm_jornada_servicio::find($id);


            $ccmjs->destroy($id);

        if ($ccmjs){
            return back()->with('success','Se ha eliminado la jornada correctamente '.$id);
        }else{
            return back()->with('error','No se ha eliminado el registro '.$id);
        }

//        return back()->with('success','Se ha eliminado la jornada correctamente '.$id);

    }
}
