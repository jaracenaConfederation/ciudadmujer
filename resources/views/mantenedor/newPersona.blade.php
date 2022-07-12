@extends('layout.Registro.formRegistroly')

@section('Titulo')
     de Persona
@endsection


@section('contenido')

   {{Form:: open(array('method'=>'post','url'=>'#'))}}


          {{Form::label('Nombres: ')}}
          {{Form::text('nombres')}}
          &nbsp;
          {{Form::label('Apellidos:')}}
          {{Form::text('apellidos')}}
   &nbsp;


        {{Form::label('Alias: ')}}
        {{Form::text('alias')}}
        &nbsp;
        {{Form::label('Algo mas:')}}
        {{Form::text('algo')}}


   {{Form::close()}}


   <div class="container">

       <div class="panel panel-primary">

           <div class="panel-heading">

               Mi calendario

           </div>

           <div class="panel-body" >

               {!! $calendar->calendar() !!}

               {!! $calendar->script() !!}

           </div>

       </div>

   </div>


@endsection