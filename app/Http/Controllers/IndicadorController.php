<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tmodulo_Referencia;
use App\Indicadores;
use App\Indicador_Estado;
use App\Indicador_Unidad;



class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $indicador_general = Indicadores::orderBy('id_indicador','ASC')->paginate(10);
//        $indicador_estado = Indicador_Estado::all();
//        $indicador_unidad = Indicador_Unidad::all();
//        $m = Treferencia_Modulo::all();
//        return view('mindicadores.indicadores')->with('modulo',$m)->with('indicadorgeneral',$indicador_general)->with('indicadorestado',$indicador_estado)->with('indicadorunidad',$indicador_unidad);

        


        $indicador_general = Indicadores::orderBy('id_indicador','ASC')->paginate(6);
        $indicador_general->each(function ($indicador_general){
            $indicador_general->indicador_estado;
            $indicador_general->indicador_unidad;
            $indicador_general->treferencia_modulo;
        });
        $m = Tmodulo_Referencia::all();
//        dd($indicador_general);

        return view('mindicadores.indicadores')->with('modulo',$m)->with('indicadorgeneral',$indicador_general);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indicadores  $indicadores
     * @return \Illuminate\Http\Response
     */
    public function show(Indicadores $indicadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indicadores  $indicadores
     * @return \Illuminate\Http\Response
     */
    public function edit(Indicadores $indicadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indicadores  $indicadores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indicadores $indicadores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indicadores  $indicadores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indicadores $indicadores)
    {
        //
    }
}
