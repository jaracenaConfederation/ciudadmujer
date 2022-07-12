<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Event;
use App\Tmodulo_Referencia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];
        $data = Event::all();
        $modulos=Tmodulo_Referencia::orderby('n_modulo_referencia','asc')->get(['id_modulo_referencia','n_modulo_referencia']);
        $m[0]='Seleccione Modulo...';
        foreach ($modulos as $mod){
            $m[$mod->id_modulo_referencia]= $mod->n_modulo_referencia;
        }

        if($data->count()){
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->title,
                    false,
                    new \DateTime($value->start_date.'t'.$value->start_time),
                    new \DateTime($value->end_date.'t'.$value->end_time)
             );
            }
        }
        $calendar = Calendar::addEvents($events);

        return view('magenda.agenda', compact('calendar','m'));
//        return view('magenda.agenda', compact('calendar'));
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
        //
    }
}
