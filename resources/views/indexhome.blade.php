@extends('layout.homeindexly')

@section('barramenu')
<h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-block">Menú de Opciones</h3>
@endsection
@section('contenido')
    @include ('fragment.error')
    <div class="well well-sm col-lg-6 col-md-8 col-sm-10 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
        <div class="text-center"><h3 class="text-center">Menú de Opciones</h3></div>
            <div class="input-group center-block text-center content-cell ">
                <div class="trans " style="padding: 3px"><a href="{{url('/agenda')}}" class="btn btn-success" type="button" style="width: 200px">Agendamiento de Citas</a></div>
                <div class="trans " style="padding: 3px"><a href="{{url('/otaller')}}" class="btn btn-success" type="button" style="width: 200px">Talleres y Actividades</a></div>
                <div class="trans " style="padding: 3px"><a class="btn btn-success" type="button" style="width: 200px">Atención CCM</a></div>
                <div class="trans " style="padding: 3px"><a class="btn btn-success" type="button" style="width: 200px">Monitoreo y Seguimiento</a></div>
                <div class="trans " style="padding: 3px"><a class="btn btn-success" type="button" style="width: 200px">Reportabilidad</a></div>
            </div>
    </div><!-- well -->
@endsection
