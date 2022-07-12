<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Tmodulo_Referencia;
use App\tservicio_referencia;
use App\centrocm_jornada;
use App\centrocm_jornada_servicio;
use App\centrocm_jornada_servicio_turno;
use App\centrocm_servicio_prestadora;
use App\centrocmjornada_noatiende;
use App\centrocm_jornada_servicio_noatiende;
use App\Cita_Agendamiento;
use App\tprestadora;
use App\tcentrocm;
use App\centrocm_servicio_prestadora_noatiende;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;



class CitaAgendamientoController extends Controller
{

    public function index()
    {
        $cita = null;

        $modulosdisponibles = DB::table('centrocm_servicio_prestadora')
            ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

            ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')

            ->distinct('tmodulo_referencia.id_modulo_referencia','tmodulo_referencia.n_modulo_referencia')

            ->get(array('tmodulo_referencia.id_modulo_referencia','tmodulo_referencia.n_modulo_referencia'));

        $m[0]='Seleccione Modulo...';

        foreach ($modulosdisponibles as $mod){
            $m[$mod->id_modulo_referencia]= $mod->n_modulo_referencia;
        }
        return view('magenda.agenda', compact('cita', 'm'));
    }

    public function show($id,$time)
    {
        $hoy=Carbon::now()->format('Y-m-d');

        if ($time=='past'){
            if ($id != '-1'){
                $cita = DB::table('cita_agendamiento')
                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')
                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')
                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
                    ->where('cita_agendamiento.id_cm',$id)
                   //  ->where('fecha_cita','>=',"'".$hoy."'")
                    ->distinct('cita_agendamiento.id_cita_agendamiento')
                    ->get();
            }else{
                $cita = DB::table('cita_agendamiento')
                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')
                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')
                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
                   // ->where('fecha_cita','>=',"'".$hoy."'")
                    ->get();
            }

        }else{

            if ($id != '-1'){
                $cita = DB::table('cita_agendamiento')
                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')
                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')
                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
                    ->where('cita_agendamiento.id_cm',$id)
                     ->where('fecha_cita','>=',"'".$hoy."'")
                    ->distinct('cita_agendamiento.id_cita_agendamiento')
                    ->get();
            }else{
                $cita = DB::table('cita_agendamiento')
                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')
                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')
                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')
                    ->where('fecha_cita','>=',"'".$hoy."'")
                    ->get();
            }
        }


        return ($cita->toArray());
    }

    public function showFiltroUsuarias($id, $mod, $serv,$time)
    {
        $hoy=Carbon::now()->format('Y-m-d');

        if ($time == 'past'){
            if ($id != '-1'){
                $cita = DB::table('cita_agendamiento')

                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')

                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')

                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')

                    ->where('cita_agendamiento.id_cm',$id)

                    ->where ('tmodulo_referencia.id_modulo_referencia', $mod)

                    ->where('centrocm_jornada_servicio.id_servicio_referencia',$serv)

//                    ->where('fecha_cita','>=',"'".$hoy."'")

                    ->distinct('cita_agendamiento.id_cita_agendamiento')

                    ->get();
            }
            else{
                $cita = DB::table('cita_agendamiento')

                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')

                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')

                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')

                    ->where ('tmodulo_referencia.id_modulo_referencia', $mod)

                    ->where('centrocm_jornada_servicio.id_servicio_referencia',$serv)

//                    ->where('fecha_cita','>=',"'".$hoy."'")

                    ->get();

            }

        }else{
            if ($id != '-1'){
                $cita = DB::table('cita_agendamiento')

                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')

                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')

                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')

                    ->where('cita_agendamiento.id_cm',$id)

                    ->where ('tmodulo_referencia.id_modulo_referencia', $mod)

                    ->where('centrocm_jornada_servicio.id_servicio_referencia',$serv)

                    ->where('fecha_cita','>=',"'".$hoy."'")

                    ->distinct('cita_agendamiento.id_cita_agendamiento')

                    ->get();
            }
            else{
                $cita = DB::table('cita_agendamiento')

                    ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')

                    ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')

                    ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

                    ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

                    ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')

                    ->where ('tmodulo_referencia.id_modulo_referencia', $mod)

                    ->where('centrocm_jornada_servicio.id_servicio_referencia',$serv)

                    ->where('fecha_cita','>=',"'".$hoy."'")

                    ->get();

            }
        }

//        dd($cita);
        return ($cita->toArray());
    }

    public function store(Request $request)
    {
        $registro= new Cita_Agendamiento;

        $registro->id_cm                            =$request['idcm'];
        $registro->id_centrocm_servicio_prestadora  =$request['id_cen_ser_prest'];
        $registro->id_estado_cita                   =2;
        $registro->fecha_cita                       =$request['fecha'];
        $registro->hora_inicio_cita                 =$request['hora_inicio'];
        $registro->hora_termino_cita                =$request['hora_termino'];
        $registro->hora_atencion_inicio             ='10:00';
        $registro->hora_atencion_termino            ='10:30';
        $registro->observaciones                    =$request['observaciones'];
        $registro->solicitantes                     ='Misma Persona';
        $registro->id_user_registro                 =77777777;
        $registro->fecha_registro                   =20170101;

        $registro->save();
        return("Se ha llegado al controlador de nueva cita");
    }

    public function listagend($idmodulo){

        $modulosdisponibles = DB::table('centrocm_servicio_prestadora')
            ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
            ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->where('tservicio_referencia.id_modulo_referencia',$idmodulo)
            ->distinct()
            ->get(array('tservicio_referencia.id_servicio_referencia','tservicio_referencia.n_servicio_referencia'))->toarray();

        return ($modulosdisponibles);
    }

    public function listservprestadora($idmodulo,$idservicio){   //Este es para llenar los combos de las prestadoras.

        $modulosdisponibles = DB::table('centrocm_servicio_prestadora')

            ->join('centrocm_jornada_servicio',
                    'centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

            ->join('tservicio_referencia',
                    'centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

            ->join('centrocm_jornada',
                    'centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')

            ->join('tprestadora',
                'centrocm_servicio_prestadora.id_prestadora','=','tprestadora.id_prestadora')

            ->join('tcentrocm',
                    'centrocm_jornada.id_centrocm','=','tcentrocm.id_centrocm')

            ->where('tservicio_referencia.id_modulo_referencia',
                        $idmodulo)->where('centrocm_jornada_servicio.id_servicio_referencia',$idservicio)

            ->distinct('tprestadora.id_prestadora')

            ->get(array('tprestadora.id_prestadora'))->toarray();

        return($modulosdisponibles);
    } //No tocar

    public function listservprestadora_cal($idmodulo,$idservicio){

        $modulosdisponibles= DB::table('centrocm_servicio_prestadora')
            ->join('centrocm_jornada_servicio',
                'centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
            ->join('tservicio_referencia',
                'centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
            ->join('centrocm_jornada',
                'centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')
            ->join('tcentrocm',
                'centrocm_jornada.id_centrocm','=','tcentrocm.id_centrocm')
            ->join('centrocm_jornada_servicio_turno',
                'centrocm_jornada_servicio.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio_turno.id_centrocm_jornada_servicio')
            ->where('tservicio_referencia.id_modulo_referencia',$idmodulo)
            ->where('centrocm_jornada_servicio.id_servicio_referencia',$idservicio)
            ->get(array('centrocm_servicio_prestadora.id_centrocm_jornada_servicio','cjsthora_inicio','cjsthora_termino','centrocm_jornada_servicio.id_servicio_referencia','n_servicio_referencia','id_modulo_referencia','cjdia','id_prestadora','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora','centrocm_jornada_servicio_turno.id_turno','csphora_inicio','csphora_termino'))->toarray();

//            ->get(array('centrocm_servicio_prestadora.id_centrocm_jornada_servicio','cjsthora_inicio','cjsthora_termino','centrocm_jornada_servicio.id_servicio_referencia','n_servicio_referencia','id_modulo_referencia','cjdia','id_prestadora','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora','centrocm_jornada_servicio_turno.id_turno'))->toarray();

        setlocale(LC_TIME, 'America/Santiago');
        $hoy=Carbon::now();

        $cita_agendada = DB::table('cita_agendamiento')->where('cita_agendamiento.fecha_cita','>',$hoy->toDateString())->get();
        $centrocm_noatiende= centrocmjornada_noatiende::get();
        $centrocm_servicio_noatiende= centrocm_jornada_servicio_noatiende::get();
        $centrocm_servicio_prestadora_noatiende = centrocm_servicio_prestadora_noatiende::get();
        $fechas=[];
        $marca_existe=0;

        $week= ['Monday'    =>'lunes',
                'Tuesday'   =>'martes',
                'Wednesday' =>'miércoles',
                'Thursday'  =>'jueves',
                'Friday'    =>'viernes',
                'Saturday'  =>'sábado',
                'Sunday'    =>'domingo'];
        $i = 0;
        $fecha_actual = strtotime(Carbon::now('America/Santiago'));
        $marca_coincide_no_atiende_cmjornada=0;

        while ($i<=90) {
            $spaniolday = $week[$hoy->format('l')];
            $fech= $hoy->toDateString();

                foreach ($modulosdisponibles as $modulo) {

                    foreach ($cita_agendada as $cita_a){

                        if(($cita_a->id_centrocm_servicio_prestadora == $modulo->id_centrocm_servicio_prestadora) && ($cita_a->fecha_cita == $fech)  && ($cita_a->hora_inicio_cita == $modulo->cjsthora_inicio)){
                            $marca_existe=1;
                        }
                    }

                if ($marca_existe == 0) {

                     if (( strtotime($modulo->csphora_inicio) <= strtotime($modulo->cjsthora_inicio)) && ( strtotime($modulo->csphora_termino) >= strtotime($modulo->cjsthora_termino))){ //Se consulta por las horas que estan definidas entre los turnos y el horario de atencion de la prestadora

                        if ($modulo->cjdia == $spaniolday) {

                            $fecha_evento = $fech . ' ' . $modulo->cjsthora_inicio;

                            $mod_cjsthora_inicio = strtotime($modulo->cjsthora_inicio);
                            $mod_cjsthora_termino = strtotime($modulo->cjsthora_termino);

                            $fecha_evento = strtotime($fecha_evento);

                            if ($fecha_actual <= $fecha_evento) {


                                foreach ($centrocm_noatiende as $no_atiende) {

                                    $time = strtotime(strval($no_atiende->cjnafecha));
                                    $h_ini = strtotime($no_atiende->cjnahora_inicio);
                                    $h_ter = strtotime($no_atiende->cjnahora_termino);

                                    $fech_no_atiende_date = date('Y-m-d', $time);

                                    if (($fech_no_atiende_date == $fech) && ($mod_cjsthora_inicio >= $h_ini) && ($mod_cjsthora_termino <= $h_ter)) {
                                        $marca_coincide_no_atiende_cmjornada = 1;
                                        $mensaje = $no_atiende->cjnaobservaciones;
                                    }

                                }

                                foreach ($centrocm_servicio_noatiende as $no_atiende_servicio) {

                                    $timeservicio = strtotime(strval($no_atiende_servicio->cjsnafecha));
                                    $h_ini = strtotime($no_atiende_servicio->cjsnahora_inicio);
                                    $h_ter = strtotime($no_atiende_servicio->cjsnahora_termino);

                                    $fech_no_atiende_date = date('Y-m-d', $timeservicio);

                                    if (($fech_no_atiende_date == $fech) && ($mod_cjsthora_inicio >= $h_ini) && ($mod_cjsthora_termino <= $h_ter) && ($modulo->id_centrocm_jornada_servicio == $no_atiende_servicio->id_centrocm_jornada_servicio)) {
                                        $marca_coincide_no_atiende_cmjornada = 1;
                                        $mensaje = $no_atiende_servicio->cjsnaobservaciones;
                                    }

                                }

                                foreach ($centrocm_servicio_prestadora_noatiende as $no_atiende_servicio) {

                                    //$centrocm_servicio_prestadora_noatiende = centrocm_servicio_prestadora_noatiende::get();

                                    $timeservicio = strtotime(strval($no_atiende_servicio->cspnafecha));
                                    $h_ini = strtotime($no_atiende_servicio->cspnahora_inicio);
                                    $h_ter = strtotime($no_atiende_servicio->cspnahora_termino);


                                    $fech_no_atiende_date = date('Y-m-d', $timeservicio);


                                    if (($fech_no_atiende_date == $fech) && ($mod_cjsthora_inicio >= $h_ini) && ($mod_cjsthora_termino <= $h_ter)
                                    && ($modulo->id_centrocm_servicio_prestadora == $no_atiende_servicio->id_centrocm_servicio_prestadora)

                                    ) {

                                        $marca_coincide_no_atiende_cmjornada = 1;
                                        $mensaje = $no_atiende_servicio->cspnaobservaciones;
                                    }
                                }

                                if ($marca_coincide_no_atiende_cmjornada != 1) {
                                    array_push($fechas, array($modulo->n_servicio_referencia,
                                            $modulo->id_prestadora,
                                            $fech . ' ' . $modulo->cjsthora_inicio,
                                            $fech . ' ' . $modulo->cjsthora_termino,
                                            '#35682D',
                                            $modulo->id_centrocm_servicio_prestadora,
                                            $modulo->id_turno,
                                            $modulo->cjdia,
                                            $modulo->id_servicio_referencia)
                                    );
                                } else {
                                    array_push($fechas, array($mensaje,
                                            $modulo->id_prestadora,
                                            $fech . ' ' . $modulo->cjsthora_inicio,
                                            $fech . ' ' . $modulo->cjsthora_termino,
                                            '#FFCCFF',
                                            '-10',
                                            $modulo->id_turno,
                                            $modulo->cjdia,
                                            $modulo->id_servicio_referencia)
                                    );
                                }
                                $mensaje = '';
                                $marca_coincide_no_atiende_cmjornada = 0;
                            }
                        }

                     }

                        //*********************************************************
                }
                $marca_existe=0;
            }

            $hoy->addDay(1);
            $i++;
        }
        return ($fechas);
    }// public function listservprestadora_cal($idmodulo,$idservicio){

    public function listservprestadora_calfiltro($idmodulo,$idservicio,$idprestadora){
        if ($idprestadora > -1)
        {
            $modulosdisponibles = DB::table('centrocm_servicio_prestadora')

                ->join('centrocm_jornada_servicio',
                    'centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                ->join('tservicio_referencia',
                    'centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
                ->join('centrocm_jornada',
                    'centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')
                ->join('tcentrocm',
                    'centrocm_jornada.id_centrocm','=','tcentrocm.id_centrocm')
                ->join('centrocm_jornada_servicio_turno',
                    'centrocm_jornada_servicio.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio_turno.id_centrocm_jornada_servicio')
                ->where('tservicio_referencia.id_modulo_referencia',$idmodulo)
                ->where('centrocm_jornada_servicio.id_servicio_referencia',$idservicio)
                ->where('centrocm_servicio_prestadora.id_prestadora',$idprestadora)

//                ->get(array('centrocm_servicio_prestadora.id_centrocm_jornada_servicio',
//                    'cjsthora_inicio','cjsthora_termino','centrocm_jornada_servicio.id_servicio_referencia',
//                    'n_servicio_referencia','id_modulo_referencia','cjdia','id_prestadora',
//                    'centrocm_servicio_prestadora.id_centrocm_servicio_prestadora','centrocm_jornada_servicio_turno.id_turno'))->toarray();

                ->get(array('centrocm_servicio_prestadora.id_centrocm_jornada_servicio',
                    'cjsthora_inicio','cjsthora_termino','centrocm_jornada_servicio.id_servicio_referencia',
                    'n_servicio_referencia','id_modulo_referencia','cjdia','id_prestadora',
                    'centrocm_servicio_prestadora.id_centrocm_servicio_prestadora','centrocm_jornada_servicio_turno.id_turno',
                    'csphora_inicio','csphora_termino'))->toarray();
        }
        else
            {
            $modulosdisponibles = DB::table('centrocm_servicio_prestadora')
                ->join('centrocm_jornada_servicio',
                    'centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')
                ->join('tservicio_referencia',
                    'centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')
                ->join('centrocm_jornada',
                    'centrocm_jornada_servicio.id_centrocm_jornada','=','centrocm_jornada.id_centrocm_jornada')
                ->join('tcentrocm',
                    'centrocm_jornada.id_centrocm','=','tcentrocm.id_centrocm')
                ->join('centrocm_jornada_servicio_turno',
                    'centrocm_jornada_servicio.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio_turno.id_centrocm_jornada_servicio')
                ->where('tservicio_referencia.id_modulo_referencia',$idmodulo)
                ->where('centrocm_jornada_servicio.id_servicio_referencia',$idservicio)


//                ->get(array('centrocm_servicio_prestadora.id_centrocm_jornada_servicio',
//                    'cjsthora_inicio','cjsthora_termino','centrocm_jornada_servicio.id_servicio_referencia',
//                    'n_servicio_referencia','id_modulo_referencia','cjdia','id_prestadora',
//                    'centrocm_servicio_prestadora.id_centrocm_servicio_prestadora','centrocm_jornada_servicio_turno.id_turno'))->toarray();

                ->get(array('centrocm_servicio_prestadora.id_centrocm_jornada_servicio',
                    'cjsthora_inicio','cjsthora_termino','centrocm_jornada_servicio.id_servicio_referencia',
                    'n_servicio_referencia','id_modulo_referencia','cjdia','id_prestadora',
                    'centrocm_servicio_prestadora.id_centrocm_servicio_prestadora','centrocm_jornada_servicio_turno.id_turno',
                    'csphora_inicio','csphora_termino'))->toarray();
        }

        setlocale(LC_TIME, 'America/Santiago');
        $hoy=Carbon::now();
        $fecha_actual=strtotime(Carbon::now('America/Santiago'));
        $cita_agendada = DB::table('cita_agendamiento')->where('cita_agendamiento.fecha_cita','>=',$hoy->toDateString())->get();
        $centrocm_noatiende= centrocmjornada_noatiende::get();
        $centrocm_servicio_noatiende= centrocm_jornada_servicio_noatiende::get();
        $centrocm_servicio_prestadora_noatiende = centrocm_servicio_prestadora_noatiende::get();

        $fechas=[];
        $marca_existe=0;
        $week= ['Monday'    =>'lunes',
                'Tuesday'   =>'martes',
                'Wednesday' =>'miércoles',
                'Thursday'  =>'jueves',
                'Friday'    =>'viernes',
                'Saturday'  =>'sábado',
                'Sunday'    =>'domingo'];
        $i = 0;

        $marca_coincide_no_atiende_cmjornada=0;

        while ($i<=90) {
            $spaniolday = $week[$hoy->format('l')];
            $fech = $hoy->toDateString();

            foreach ($modulosdisponibles as $modulo) {

                foreach ($cita_agendada as $cita_a){
                    if(($cita_a->id_centrocm_servicio_prestadora == $modulo->id_centrocm_servicio_prestadora) && ($cita_a->fecha_cita == $fech)  && ($cita_a->hora_inicio_cita == $modulo->cjsthora_inicio)){
                        $marca_existe=1;
                    }
                }

                if ($marca_existe == 0) {

                    if (( strtotime($modulo->csphora_inicio) <= strtotime($modulo->cjsthora_inicio)) && ( strtotime($modulo->csphora_termino) >= strtotime($modulo->cjsthora_termino))){ //Se consulta por las horas que estan definidas entre los turnos y el horario de atencion de la prestadora

                        if ($modulo->cjdia == $spaniolday) {

                            $fecha_evento = $fech . ' ' . $modulo->cjsthora_inicio;

                            $mod_cjsthora_inicio = strtotime($modulo->cjsthora_inicio);
                            $mod_cjsthora_termino = strtotime($modulo->cjsthora_termino);

                            $fecha_evento = strtotime($fecha_evento);

                            if ($fecha_actual <= $fecha_evento) {


                                foreach ($centrocm_noatiende as $no_atiende) {

                                    $time = strtotime(strval($no_atiende->cjnafecha));
                                    $h_ini = strtotime($no_atiende->cjnahora_inicio);
                                    $h_ter = strtotime($no_atiende->cjnahora_termino);

                                    $fech_no_atiende_date = date('Y-m-d', $time);

                                    if (($fech_no_atiende_date == $fech) && ($mod_cjsthora_inicio >= $h_ini) && ($mod_cjsthora_termino <= $h_ter)) {
                                        $marca_coincide_no_atiende_cmjornada = 1;
                                        $mensaje = $no_atiende->cjnaobservaciones;
                                    }

                                }

                                foreach ($centrocm_servicio_noatiende as $no_atiende_servicio) {

                                    $timeservicio = strtotime(strval($no_atiende_servicio->cjsnafecha));
                                    $h_ini = strtotime($no_atiende_servicio->cjsnahora_inicio);
                                    $h_ter = strtotime($no_atiende_servicio->cjsnahora_termino);

                                    $fech_no_atiende_date = date('Y-m-d', $timeservicio);

                                    if (($fech_no_atiende_date == $fech) && ($mod_cjsthora_inicio >= $h_ini) && ($mod_cjsthora_termino <= $h_ter) && ($modulo->id_centrocm_jornada_servicio == $no_atiende_servicio->id_centrocm_jornada_servicio)) {
                                        $marca_coincide_no_atiende_cmjornada = 1;
                                        $mensaje = $no_atiende_servicio->cjsnaobservaciones;
                                    }

                                }

                                foreach ($centrocm_servicio_prestadora_noatiende as $no_atiende_servicio) {

                                    $timeservicio = strtotime(strval($no_atiende_servicio->cspnafecha));
                                    $h_ini = strtotime($no_atiende_servicio->cspnahora_inicio);
                                    $h_ter = strtotime($no_atiende_servicio->cspnahora_termino);


                                    $fech_no_atiende_date = date('Y-m-d', $timeservicio);


                                    if (($fech_no_atiende_date == $fech) && ($mod_cjsthora_inicio >= $h_ini) && ($mod_cjsthora_termino <= $h_ter)
                                        && ($modulo->id_centrocm_servicio_prestadora == $no_atiende_servicio->id_centrocm_servicio_prestadora)) {

                                        $marca_coincide_no_atiende_cmjornada = 1;
                                        $mensaje = $no_atiende_servicio->cspnaobservaciones;
                                    }
                                }

                                if ($marca_coincide_no_atiende_cmjornada != 1) {
                                    array_push($fechas, array($modulo->n_servicio_referencia,
                                            $modulo->id_prestadora,
                                            $fech . ' ' . $modulo->cjsthora_inicio,
                                            $fech . ' ' . $modulo->cjsthora_termino,
                                            '#35682D',
                                            $modulo->id_centrocm_servicio_prestadora,
                                            $modulo->id_turno,
                                            $modulo->cjdia,
                                            $modulo->id_servicio_referencia)
                                    );
                                } else {
                                    array_push($fechas, array($mensaje,
                                            $modulo->id_prestadora,
                                            $fech . ' ' . $modulo->cjsthora_inicio,
                                            $fech . ' ' . $modulo->cjsthora_termino,
                                            '#FFCCFF',
                                            '-10',
                                            $modulo->id_turno,
                                            $modulo->cjdia,

                                            $modulo->id_servicio_referencia)
                                    );
                                }
                                $mensaje = '';
                                $marca_coincide_no_atiende_cmjornada = 0;
                            }
                        }

                    }

                    //*********************************************************
                }//EL if actualizado

                $marca_existe=0;
            }
            $hoy->addDay(1);
            $i++;
        }

        return ($fechas);
    }

    public function destroy(Request $request){

        $id =  $request['id_cit_agen'];

        $evento = Cita_Agendamiento::find($id);

        if($evento== null){
            return Response()->json(['mensaje'=>'Error. No se ha eliminado la cita porque no existe']);
        }


        $evento->delete();
        return Response()->json(['mensaje'=>'Excelente. Se ha eliminado la cita correctamente']);
    }

    public function update(Request $request){

        $id =  $request['id_cit_agen'];
        $f =  $request['fecha'];
        $hi =  $request['hora_inicio'];
        $ht =  $request['hora_termino'];

        $evento = Cita_Agendamiento::find($id);

        if($evento== null){
            return Response()->json(['mensaje'=>'Error. No se ha actualizado la cita porque no existe']);
        }


        $evento->observaciones = $request['observaciones'];
        $evento->fecha_cita = $request['fecha'];
        $evento->hora_inicio_cita = $request['hora_inicio'];
        $evento->hora_termino_cita = $request['hora_termino'];
        $evento->id_centrocm_servicio_prestadora  =$request['id_cen_ser_prest'];
        $evento->save();
        return Response()->json(['mensaje'=>'Excelente. Se ha actualizado la cita correctamente']);
    }

    public function showMovil($id)
    {
        $hoy=Carbon::now()->format('Y-m-d');
        $cita = DB::table('cita_agendamiento')

                ->join('centrocm_servicio_prestadora','cita_agendamiento.id_centrocm_servicio_prestadora','=','centrocm_servicio_prestadora.id_centrocm_servicio_prestadora')

                ->join('registro_usuaria','cita_agendamiento.id_cm','=','registro_usuaria.id_cm')

                ->join('centrocm_jornada_servicio','centrocm_servicio_prestadora.id_centrocm_jornada_servicio','=','centrocm_jornada_servicio.id_centrocm_jornada_servicio')

                ->join('tservicio_referencia','centrocm_jornada_servicio.id_servicio_referencia','=','tservicio_referencia.id_servicio_referencia')

                ->join('tmodulo_referencia','tmodulo_referencia.id_modulo_referencia','=','tservicio_referencia.id_modulo_referencia')

                ->where('registro_usuaria.movil1',$id)

                ->where('fecha_cita','>=',"'".$hoy."'")
                ->distinct('cita_agendamiento.id_cita_agendamiento')
                ->get();


        //dd($cita);
        return ($cita);
    }

}
