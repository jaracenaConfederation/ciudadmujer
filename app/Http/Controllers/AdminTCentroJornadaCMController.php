<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\centrocmjornada;
use App\tcentrocm;

class AdminTCentroJornadaCMController extends Controller
{

    public function index()
    {
        $registrocentrojornada = centrocmjornada::orderBy('id_centrocm_jornada','ASC')->paginate(9999);
        $registrocentrojornada->each(function($registrocentrojornada){
            $registrocentrojornada->centrocm;
//            $registrotaller->treferencia_modulo;
        });
//        var_dump($registrotaller);exit;

        $centros = tcentrocm::all();
//        dd($registrotaller->toArray());
        return view('magenda.agendaadmin_centrojornada')->with('registrocentrojornada',$registrocentrojornada)->with('centros',$centros);
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
        $registroJornada = new centrocmjornada;

        $registroJornada->id_centrocm = $request['comboCentro'];
        $registroJornada->n_jornada = $request['comboJornada'];
        $registroJornada->cjdia = $request['comboDia'];
        $registroJornada->cjhora_inicio = $request['textHoraIniciohjornada'];
        $registroJornada->cjhora_termino = $request['textHoraTerminohjornada'];
        $registroJornada->save();

        return back()->with('success','La jornada ' . $registroJornada->id_centrocm_jornada . ' "' . $registroJornada->n_jornada . '" se ha creado correctamente');
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
        $registroJornada = centrocmjornada::find($id);
        $registroJornada->delete();
        return back()->with('success','La jornada ' . $registroJornada->id_centrocm_jornada . ' se ha eliminado correctamente');
    }
}
