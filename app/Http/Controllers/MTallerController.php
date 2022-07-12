<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tmodulo_Referencia;
use App\Registro_Taller;
use App\Registro_Version;

class MTallerController extends Controller
{
    public function index()
    {
        $registroversion = Registro_Version::orderBy('id_registro_version','ASC')->paginate(9999);
        $modulo= Tmodulo_Referencia::all();

        $registroversion->each(function($registroversion){
            $registroversion->registro_taller;
        });

        //       dd($registroversion->toArray());
        return view('mtaller.mtaller')->with('modulo',$modulo)->with('registroversion',$registroversion);
    }

    public function carga_ofertas($id)
    {
        $ofertas= Registro_Version::all()->where('id_registro_taller',$id);
        dd($ofertas);
//        return view('mtaller.mtaller')->with('registrotaller',$registrotaller)->with('modulo',$modulo);
    }
    public function create()
    {

    }

    public function store(Request $request)
    {
        $registro = new registro_version;

        $registro->n_registro_version = $request['textNombreTaller'];
        $registro->id_registro_taller = $request['listamodulos'];
//        $registro->id_referencia_taller = $request['listaservicios'];
        $registro->tema_general = $request['comment'];
        $registro->fecha_inicio = $request['fechaInicioTaller2'];
        $registro->fecha_termino = $request['fechaFinTaller2'];
        $registro->cupos = $request['cuposTaller'];
        $registro->activo = 'S';
        $registro->finalizado = 'N';
        $registro->institucion_responsable = $request['textInstitucionResponsable'];

        $registro->save();

        return back()->with('info','El taller ' . $registro->id_registro_version . ' "' . $registro->n_registro_version . '" se ha creado correctamente');
    }

    public function finaliza($id)
    {
        $registro = Registro_Version::find($id);

        if($registro->finalizado == 'N') {
            $registro->finalizado = 'S';
            $registro->save();

            return back()->with('info','El taller ' . $registro->id_registro_version . ' "' . $registro->n_registro_version . '" se ha finalizado correctamente');
        }
    }

    public function reinicia($id)
    {
        $registro = Registro_Version::find($id);

        if($registro->finalizado == 'S') {
            $registro->finalizado = 'N';
            $registro->save();

            return back()->with('info','El taller ' . $registro->id_registro_version . ' "' . $registro->n_registro_version . '" se ha reiniciado correctamente');
        }
    }
    public function activa($id)
    {
        $registro = Registro_Version::find($id);

        if($registro->activo == 'N') {
            $registro->activo = 'S';
            $registro->save();

            return back()->with('success','El taller ' . $registro->id_registro_version . ' "' . $registro->n_registro_version . '" se ha activado correctamente');
        }
    }

    public function desactiva($id)
    {
        $registro = Registro_Version::find($id);

        if($registro->activo == 'S') {
            $registro->activo = 'N';
            $registro->save();

            return back()->with('success','El taller ' . $registro->id_registro_version . ' "' . $registro->n_registro_version . '" se ha desactivado correctamente');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrotaller = registro_version::find($id);
        $registrotaller->delete();

        return back()->with('success','El taller ' . $registrotaller->id_registro_version . ' "' . $registrotaller->n_registro_version . '" se ha eliminado correctamente');
    }
}
