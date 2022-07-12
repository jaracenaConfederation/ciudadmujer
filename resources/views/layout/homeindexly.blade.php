@extends('home')
@section('titulo_pagina')
    - Menú de Opciones
@endsection

@section('content_home')
<div>
    <header>
        <div class="container">
             <div class="page-header trans">
                 <h1>
                     <img class="hidden-xs visible-sm visible-md visible-lg"  style="width: 100%" src="{{ asset('imagenes/sistema_de_informacion.png')}}">
                 </h1>
             </div>
        </div><!-- /.container-fluid -->
    </header>

    <div class="container ">

        @yield('contenido')

    </div>
</div>
@endsection