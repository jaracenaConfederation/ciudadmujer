@extends('home')

@section('content_home')
    <div>
        <header>

            <div class="container">
                <div class="page-header " style="padding-top: 10px">

                    <h1>Formulario de Registro @yield('Titulo')
                        {{--<img class="hidden-xs visible-sm visible-md visible-lg" height="140px"  src="{{ asset('images/bn_gestion_taller.png')}}">--}}
                    </h1>
                </div>


            </div><!-- /.container-fluid -->
        </header>

        <div class="container ">

            @yield('contenido')

        </div>
    </div>
@endsection