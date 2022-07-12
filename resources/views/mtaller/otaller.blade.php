@extends('layout.mtallerly')

@section('barramenu')
    <li class="active"><a href="#">Oferta Talleres/Actividades <span class="sr-only">(current)</span></a></li>
    <li><a href="{{url('/mtaller')}}">Administración Talleres/Actividades</a></li>
    <li><a href="{{url('/rtaller')}}">Registro Asistencia</a></li>
    <li><a href="{{url('/etaller')}}">Evaluación</a></li>
@endsection

@section('contenido')
    @include('fragment.info')
    @include('fragment.success')
    @include('fragment.error')
    <div class="well">

        <form action="{{route('otaller.store')}}" method="POST" name="agregarOtaller" onsubmit="return validateFormAgregar()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                    <div class="form-group">
                        <label>Módulo</label>
                        <select class="form-control" name="comboModulo" id="comboModulo" required>
                            <option value="">Seleccione...</option>
                            @foreach($modulo as $mod)
                                <option value="{{$mod->id_modulo_referencia}}">{{$mod->n_modulo_referencia}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Nombre Taller/Actividad</label>
                        <input type="text" class="form-control" name="textNombreTaller" id="textNombreTaller" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button type="submit" id="submit" class="form-control btn btn-info" title="Permite agregar el taller ofertado">Agregar</button>
                    </div>
                </div>

            </div>

        </form>

    </div>

    <div class="well" style="background-color: #FFFFFF">
        <h4>Catálogo de talleres disponibles en ciudad mujer</h4>
        <div style="background: white">

            <div >
                <table id="dataTables_otaller" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>ID</th>
                        <th nowrap>Taller/Actividad ofertado/a</th>
                        <th nowrap>Módulo</th>
                        <th nowrap>Estado</th>
                        <th nowrap width="1%"></th>
                        <th nowrap width="1%">Opción</th>
                        <th nowrap width="1%"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    //                        var_dump($registrotaller);exit
                    ?>
                    @foreach($registrotaller as $registrot)
                        <?php
                        //                                var_dump($registrot);exit
                        ?>
                        <tr>
                            <td>{{$registrot->id_registro_taller}}</td>
                            <td>{{$registrot->n_registro_taller}}</td>
                            <td>{{$registrot->tmodulo_referencia->n_modulo_referencia}}</td>
                            <td>
                                @if($registrot->activo==='S')
                                    <span>Activo</span>
                                @else
                                    <span class="text-danger">No activo</span>
                                @endif
                            </td>
                            <td>
                                @if($registrot->activo==='N')
                                    <form id="activaForm{{$registrot->id_registro_taller}}" name="activaForm" action="{{route('otaller.activa', $registrot->id_registro_taller)}}" method="POST" style="margin-bottom: 0px">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_registro_taller" value="{{$registrot->id_registro_taller}}">
                                        <input type="hidden" name="n_registro_taller" value="{{$registrot->n_registro_taller}}">
                                        <button class="btn btn-success" title="Permite activar este taller">Activar</button>
                                    </form>
                                @else
                                    <form id="desactivaForm{{$registrot->id_registro_taller}}" name="desactivaForm" action="{{route('otaller.desactiva', $registrot->id_registro_taller)}}" method="POST" style="margin-bottom: 0px">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id_registro_taller" value="{{$registrot->id_registro_taller}}">
                                        <input type="hidden" name="n_registro_taller" value="{{$registrot->n_registro_taller}}">
                                        <button class="btn btn-default" title="Permite desactivar este taller">Desactivar</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <button onclick="modalEditar('{{$registrot->id_registro_taller}}', '{{$registrot->id_modulo_referencia}}', '{{$registrot->n_registro_taller}}')" class="btn btn-default" title="Permite editar la descripcion este taller" @if($registrot->activo==='N') disabled @endif>Editar</button>
                            </td>
                            <td>
                                <form id="eliminarForm{{$registrot->id_registro_taller}}" name="eliminarForm" action="{{route('otaller.destroy', $registrot->id_registro_taller)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_registro_taller" value="{{$registrot->id_registro_taller}}">
                                    <input type="hidden" name="n_registro_taller" value="{{$registrot->n_registro_taller}}">
                                    <button class="btn btn-danger" title="Permite eliminar este taller de manera permanente">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!  $registrotaller->render() !!}
            </div>

        </div>

    </div>

    <form id="updateOtallerID" action="" method="POST" name="updateOtaller" onsubmit="return validateFormAgregarModal()">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="id_registro_taller" name="id_registro_taller">
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar Taller/Actividad</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label>Módulo</label>
                                    <select class="form-control" name="comboModulo" id="comboModuloModal">
                                        <option>Seleccione...</option>
                                        @foreach($modulo as $mod)
                                            <option value="{{$mod->id_modulo_referencia}}">{{$mod->n_modulo_referencia}}</option>
                                        @endforeach
                                    </select>
                                </div> <!-- div seleccione -->
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    <label for="">Nombre Taller/Actividad</label>
                                    <input type="text" class="form-control" name="textNombreTaller" id="textNombreTallerModal">
                                </div> <!-- div input -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-info" title="Permite eliminar el taller ofertado de manera permanente">Editar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                <!-- Modal content-->

            </div>
        </div>
    </form>

    <script type="text/javascript">
        $("[name='activaForm']").submit(function(e) {
            var currentForm = this;
            id_registro_taller = currentForm.id_registro_taller.value;
            n_registro_taller = currentForm.n_registro_taller.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea activar el taller ' + id_registro_taller + ' "' + n_registro_taller + '"?',
                buttons: {
                    confirm: {
                        label: 'Aceptar'
                    },
                    cancel: {
                        label: 'Cancelar'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        currentForm.submit();
                        waitingDialogo();
                    }
                }
            });
        });

        $("[name='desactivaForm']").submit(function(e) {
            console.log("emtro a desactivar antes de...");
            var currentForm = this;
            id_registro_taller = currentForm.id_registro_taller.value;
            n_registro_taller = currentForm.n_registro_taller.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea desactivar el taller ' + id_registro_taller + ' "' + n_registro_taller + '"?',
                buttons: {
                    confirm: {
                        label: 'Aceptar'
                    },
                    cancel: {
                        label: 'Cancelar'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        currentForm.submit();
                        waitingDialogo();
                    }
                }
            });
        });

        $("[name='eliminarForm']").submit(function(e) {
            console.log("entro a eliminar antes de...");
            var currentForm = this;
            id_registro_taller = currentForm.id_registro_taller.value;
            n_registro_taller = currentForm.n_registro_taller.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea eliminar el taller ' + id_registro_taller + ' "' + n_registro_taller + '" y sus cursos asociados?',
                buttons: {
                    confirm: {
                        label: 'Aceptar'
                    },
                    cancel: {
                        label: 'Cancelar'
                    }
                },
                callback: function (result) {
                    if (result == true) {


                        currentForm.submit();
                        waitingDialogo();
                    }
                }
            });
        });

        function validateFormAgregar() {
            var textoError = "";
            if (document.forms["agregarOtaller"]["comboModulo"].value == "Seleccione...") {
                textoError += "<li> Debe seleccionar un módulo";
            }
            if (document.forms["agregarOtaller"]["textNombreTaller"].value.trim() == "") {
                textoError += "<li> Debe escribir un nombre de Taller/Actividad";
            }
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
        }

        function validateFormAgregarModal() {
            var comboModulo = document.forms["updateOtaller"]["comboModuloModal"].value;
            var textNombreTaller = document.forms["updateOtaller"]["textNombreTallerModal"].value;
            var textoError = "";
            if (comboModulo == "Seleccione...") {
                textoError += "<li> Debe seleccionar un módulo";
            }
            if (textNombreTaller.trim() == "") {
                textoError += "<li> Debe escribir un nombre de Taller/Actividad";
            }
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            $('#myModal').modal('hide');
            waitingDialogo();
        }

        tableData = $('#dataTables_otaller').DataTable( {
            "scrollX": true,
            "columnDefs": [{
                "className": "dt-left",
                "targets": [ 1, 6 ]
            },
            {
                "className": "dt-right",
                "targets": [ 4 ]
            },
            {
                "className": "dt-center",
                "targets": [ 0, 2, 3, 5 ]
            }],
            "language": {
                "url": "json/Spanish.json"
            },
            dom: 'lBfrtip',
            "buttons": [
                {
                    "text": '<span style="color:black">Copiar</span>',
                    "extend": 'copy'
                },
                {
                    "text": '<span style="color:black">Exportar a Excel</span>',
                    "extend": 'excel',
                    "title": 'Talleres-Actividades-' + fechaActual() + '-' + horaActual(),
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3 ]
                    }
                },
                {
                    "text": '<span style="color:black">Exportar a PDF</span>',
                    "extend": 'pdf',
                    "title": 'Talleres-Actividades-' + fechaActual() + '-' + horaActual(),
//                     download: 'open',
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3 ]
                    }
                },
                {
                    "text": '<span style="color:black">Imprimir</span>',
                    "extend": 'print',
                    "title": 'Talleres/Actividades ' + fechaActualText() + ' ' + horaActualText(),
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3 ]
                    }
                }
                // 'print'
            ],
            info: false,
            ordering: false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
//            "paging": false
        } );

        function modalEditar(id, id_mod, nombre) {
            $("#comboModuloModal").val(id_mod);
            $("#textNombreTallerModal").val(nombre);
            $("#id_registro_taller").val(id);
            $('#updateOtallerID').attr('action', '/otallerupdate/' + id);

            $("#myModal").modal();
        }

    </script>

@endsection
