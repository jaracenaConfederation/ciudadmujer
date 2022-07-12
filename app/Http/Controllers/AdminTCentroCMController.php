<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tcentrocm;
use App\centrocmjornada;
use App\centrocmjornada_noatiende;


class AdminTCentroCMController extends Controller
{

    public function index()
    {
        $registrocentrojornada = centrocmjornada::orderBy('id_centrocm_jornada','ASC')->paginate(9999);
        $registrocentrojornada->each(function($registrocentrojornada){
            $registrocentrojornada->centrocm;
        });

        $centros = tcentrocm::all();

        $registrocentro = tcentrocm::orderBy('id_centrocm','ASC')->paginate(9999);

        $registrocentrojornadanoatiende = centrocmjornada_noatiende::orderBy('id_centrocm_jornada_noatiende','ASC')->paginate(9999);
        $registrocentrojornadanoatiende->each(function($registrocentrojornadanoatiende){
            $registrocentrojornadanoatiende->centrocmjornada;
        });

        $jornadas = centrocmjornada::orderBy('id_centrocm_jornada','ASC')->get();
        $jornadas->each(function($jornadas){
            $jornadas->centrocm;
        });

        return view('magenda.agendaadmin_centro')->with('registrocentro',$registrocentro)->with('registrocentrojornada',$registrocentrojornada)->with('centros',$centros)->with('registrocentrojornadanoatiende',$registrocentrojornadanoatiende)->with('jornadas',$jornadas);
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
        $registrocentro = new tcentrocm;

        $registrocentro->n_centrocm = $request['textNombreCentro'];
        $registrocentro->save();

        return back()->with('success','El centro ' . $registrocentro->id_centrocm . ' "' . $registrocentro->n_centrocm . '" se ha creado correctamente');
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
        $registrocentro = tcentrocm::find($id);

        $registrocentro->n_centrocm = $request['textNombreCentroModal'];
        $registrocentro->save();

        return back()->with('success','El centro ' . $registrocentro->id_centrocm . ' "' . $registrocentro->n_centrocm . '" se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrocentro = tcentrocm::find($id);
//        $registrocentro = Registro_Version::find($iversion->id_registro_version);
        $registrocentro -> delete();

        return back()->with('success','El centro ' . $registrocentro->id_centrocm . ' "' . $registrocentro->n_centrocm . '" y sus asociados se ha eliminado correctamente');
    }
}
