
@extends('layout.mindicadorly')

@section('barramenu')

    <li class="active">
        <a href="{{url('/indicador')}}">Administración de indicadores <span class="sr-only">(current)</span></a>
    </li>
    <li>
        <a href="{{url('/gindicadores')}}">Gestión de indicadores</a>
    </li>

@endsection

@section('contenido')



   <section class="container">
       <div class="well">

            <h4><strong>&nbsp Indicadores de Seguimiento y Monitoreo</strong></h4>


           <div class="form-row">

               <div class="form-group col-md-3">
                   <label for="comboModulo1" class="col-form-label"><small><strong>Filtrar por Módulo</strong></small></label>
                   <select class="form-control" name="comboModulo1" id="comboModulo1" >
                        <option value="">Seleccione...</option>
                        @foreach($modulo as $mod)
                            <option value = "{{$mod->id_modulo_referencia}}">{{$mod->n_modulo_referencia}}</option>
                        @endforeach
                    </select>
               </div>

           </div>

                 <div class="form-inline">

                        <div class="dt-buttons" style = " padding: 50px 20px 10px 3px ;margin-bottom: 5px">
                            <a class="btn btn-default">Copy</a>
                            <a class="btn btn-default">CSV</a>
                            <a class="btn btn-default">Excel</a>
                            <a class="btn btn-default">PDF</a>
                            <a class="btn btn-default">Print</a>

                            <form class="navbar-form navbar-right" role="search">Buscar:<input type="text" class="form-control"></form>
                        </div>
                 </div>



                 <table class="table table-hover table-striped">

                     <thead class="thead-inverse">
                            <tr style="text-align: left;">
                               <th class="col-lg-1 text-center" style="background-color: #d5d5d5">ID</th>
                               <th class="col-md-3 text-center" style="background-color: #ebebeb">Nombre</th>
                               <th class="col-lg-2 text-center" style="background-color: #d5d5d5">Módulo CM</th>
                               <th class="col-lg-2 text-center" style="background-color: #d5d5d5">Unidad</th>
                               <th class="col-lg-2 text-center" style="background-color: #d5d5d5">Descripción</th>
                               <th class="col-lg-2 text-center" style="background-color: #d5d5d5">Estado</th>
                               <th class="col-lg-2" style="background-color: #d5d5d5">&nbsp;</th>
                               <th class="col-lg-2" style="background-color: #d5d5d5">&nbsp;</th>
                               <th class="col-lg-2" style="background-color: #d5d5d5">&nbsp;</th>
                            </tr>
                     </thead>
                     <tbody>

                        @foreach( $indicadorgeneral as $ind)
                            <tr>
                                <td>{{$ind->id_indicador }}</td>
                                <td>{{$ind->nombre_indicador}}</td>
                                <td>{{$ind->id_modulo_referencia }}</td>
                                <td>{{$ind->id_indicador_unidad}}</td>
                                <td>{{$ind->descripcion}}</td>
                                <td>{{$ind->id_indicador_estado}}</td>
                                <td>{{$ind->id_indicador_estado}}</td>
                                <td class="success">editar</td>
                                <td class="danger">eliminar</td>
                            </tr>
                        @endforeach

                     </tbody>
                  </table>
                          {!! $indicadorgeneral ->render() !!}

       </div>
   </section>

@endsection