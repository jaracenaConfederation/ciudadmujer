<?php

namespace App\Http\Controllers;

use App\Tmodulo_Referencia;
use Illuminate\Http\Request;

class TreferenciaModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Tmodulo_Referencia  $treferencia_Modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Tmodulo_Referencia $treferencia_Modulo)
    {
            dd($treferencia_Modulo->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tmodulo_Referencia  $treferencia_Modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tmodulo_Referencia $treferencia_Modulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tmodulo_Referencia  $treferencia_Modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tmodulo_Referencia $treferencia_Modulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tmodulo_Referencia  $treferencia_Modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tmodulo_Referencia $treferencia_Modulo)
    {
        //
    }
}
