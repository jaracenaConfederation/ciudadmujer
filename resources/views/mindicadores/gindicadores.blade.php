
@extends('layout.mindicadorly')

    @section('barramenu')

        <li ><a href="{{url('/indicador')}}">Administración de indicadores <span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="{{url('/gindicadores')}}">Gestión de indicadores</a></li>

    @endsection

    @section('contenido')

        <section class="container">
            <div class="row">
                <div class="col-xs-10 col-md-12 well">

                    <h4><strong>Gestión de indicadores</strong></h4>

                    <form class="form-inline" role="form">
                        <div class="form-group">

                            <p><small><strong> Módulo</strong></small></p>

                                <select class="form-control">
                                    <option>Todos</option>
                                    <option>MSSR</option>
                                    <option>MVCM</option>
                                    <option>MAA</option>
                                    <option>MAE</option>
                                    <option>MEC</option>
                                    <option>Referencia Externa</option>
                                </select>
                        </div>
                           <div class="form-group">
                            <p><small><strong>Periodo</strong></small></p>

                                <select class="form-control">
                                    <option>Seleccionar</option>
                                    <option>2017-Enero</option>
                                    <option>2017-Febrero</option>
                                </select>
                           </div>

                    </form>


                </div>
            </div>
        </section>
    @endsection