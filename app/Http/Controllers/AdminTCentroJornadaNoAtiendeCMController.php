<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\centrocmjornada_noatiende;
use App\centrocmjornada;

class AdminTCentroJornadaNoAtiendeCMController extends Controller
{

    public function index()
    {
        $registrocentrojornadanoatiende = centrocmjornada_noatiende::orderBy('id_centrocm_jornada_noatiende','ASC')->paginate(9999);
        $registrocentrojornadanoatiende->each(function($registrocentrojornadanoatiende){
            $registrocentrojornadanoatiende->centrocmjornada;
        });

        $jornadas = centrocmjornada::orderBy('id_centrocm_jornada','ASC')->get();
        $jornadas->each(function($jornadas){
            $jornadas->centrocm;
        });

        return view('magenda.agendaadmin_centrojornadanoatiende')->with('registrocentrojornadanoatiende',$registrocentrojornadanoatiende)->with('jornadas',$jornadas);
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registrocentrojornadanoatiende = new centrocmjornada_noatiende;

        $registrocentrojornadanoatiende->id_centrocm_jornada = $request['comboJornadas'];
        $registrocentrojornadanoatiende->cjnafecha = $request['fechaNoAtiende2'];
        $registrocentrojornadanoatiende->cjnahora_inicio = $request['textHoraInicio'];
        $registrocentrojornadanoatiende->cjnahora_termino = $request['textHoraTermino'];
        $registrocentrojornadanoatiende->cjnaobservaciones = $request['textObservaciones'];
        $registrocentrojornadanoatiende->save();

        return back()->with('success','La jornada no atiende ' . $registrocentrojornadanoatiende->id_centrocm_jornada_noatiende . ' se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrocentrojornadanoatiende = centrocmjornada_noatiende::find($id);
        $registrocentrojornadanoatiende->delete();
        return back()->with('success','La jornada no atiende ' . $registrocentrojornadanoatiende->id_centrocm_jornada_noatiende . ' se ha eliminado correctamente');
    }
}
