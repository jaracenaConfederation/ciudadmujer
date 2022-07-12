@extends('home')
@section('titulo_pagina')
    - Talleres y Actividades
@endsection

@section('content_home')
<div>
    <header>
        <div class="container trans">
             <div class="page-header">
                 <h1><img class="hidden-xs visible-sm visible-md visible-lg" style="width: 100%"  src="{{ asset('imagenes/Talleres_Actividades.png')}}"></h1>
             </div>

            <nav class="navbar navbar-default">

                       <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">

                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="visible-xs hidden-sm hidden-md hidden-lg"><H1>Talleres y Actividades</H1></span>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">

                                @yield('barramenu')

                            </ul>
                        </div>
            </nav>
        </div><!-- /.container-fluid -->
    </header>

    <div class="container ">

        @yield('contenido')

    </div>
</div>

@yield('funciones')

@endsection