@extends('layout.mtallerly')

    @section('barramenu')
        <li><a href="{{url('/otaller')}}">Oferta de talleres</a></li>
        <li><a href="{{url('/mtaller')}}">Administración de talleres</a></li>
        <li class="active" ><a href="#">Registro de asistencia<span class="sr-only">(current)</span></a></li>
        <li><a href="{{url('/etaller')}}">Evaluación de talleres</a></li>

    @endsection

    @section('contenido')
        <div class="well">

            <div>
                <p>Este es el contenido del formulario rtaller</p>
            </div>
        </div>

        <div class="well">
            <div>
                <p>Este es el contenido del formulario rtaller</p>
            </div>

        </div>

        <div class="well">
            <div>
                <p>Este es el contenido del formulario rtaller</p>
            </div>

        </div>


    @endsection