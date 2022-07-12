<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tmodulo_Referencia;
use App\Registro_Taller;
use App\Registro_Version;

class OTallerController extends Controller
{

    public function index()
    {
        $registrotaller = Registro_Taller::orderBy('id_registro_taller','ASC')->paginate(9999);
        $registrotaller->each(function($registrotaller){
            $registrotaller->tmodulo_referencia;
//            $registrotaller->treferencia_modulo;
        });
//        var_dump($registrotaller);exit;

        $modulo = Tmodulo_Referencia::all();
//        dd($registrotaller->toArray());
        return view('mtaller.otaller')->with('registrotaller',$registrotaller)->with('modulo',$modulo);
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
        $registro = new Registro_Taller;

        $registro->n_registro_taller = $request['textNombreTaller'];
        $registro->id_modulo_referencia = $request['comboModulo'];
        $registro->activo = 'S';
        $registro->save();

        return back()->with('success','El taller ' . $registro->id_registro_taller . ' "' . $registro->n_registro_taller . '" se ha creado correctamente');
    }

    public function activa($id)
    {
        $registro = Registro_Taller::find($id);

        if($registro->activo == 'N') {
            $registro->activo = 'S';
            $registro->save();
            return back()->with('success','El taller ' . $registro->id_registro_taller . ' "' . $registro->n_registro_taller . '" se ha activado correctamente');
        }
    }

    public function desactiva($id)
    {
        $registro=Registro_Taller::find($id);
        if($registro->activo == 'S') {
            $registro->activo = 'N';
            $registro->save();
            return back()->with('success','El taller ' . $registro->id_registro_taller . ' "' . $registro->n_registro_taller . '" se ha desactivado correctamente');
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
        $registrotaller = Registro_Taller::find($id);

        $registrotaller->n_registro_taller = $request['textNombreTaller'];
        $registrotaller->id_modulo_referencia = $request['comboModulo'];
        $registrotaller->activo = 'S';
        $registrotaller->save();

        return back()->with('success','El taller ' . $registrotaller->id_registro_taller . ' "' . $registrotaller->n_registro_taller . '" se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrotaller = Registro_Taller::find($id);
        $iversion = Registro_Version::all()->where('id_registro_taller',$id)->first();
        if ($iversion != null) {
            $registroversion = Registro_Version::find($iversion->id_registro_version);
            if (count($registroversion) > 0) {
                $registroversion->delete();
            }
        }
        $registrotaller->delete();
        return back()->with('success','El taller ' . $registrotaller->id_registro_taller . ' "' . $registrotaller->n_registro_taller . '" y sus cursos asociados se ha eliminado correctamente');
    }
}
