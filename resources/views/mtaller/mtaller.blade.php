@extends('layout.mtallerly')

@section('barramenu')
    <li><a href="{{url('/otaller')}}">Oferta de talleres</a></li>
    <li class="active"><a href="#">Administración de talleres<span class="sr-only">(current)</span></a></li>
    <li><a href="{{url('/rtaller')}}">Registro de asistencia</a></li>
    <li><a href="{{url('/etaller')}}">Evaluación de talleres</a></li>
@endsection

@section('contenido')
    {{--<script src="js/functions.js"></script>--}}

    @include('fragment.info')
    @include('fragment.success')
    @include('fragment.error')
    <div class="well">

        <form action="{{route('mtaller.store')}}" method="POST" name="agregarMtaller" onsubmit="return validateFormAgregar()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Módulo</label>
                        <select class="form-control" name="listamodulos" id="listamodulos" required>
                            <option value="">Seleccione...</option>
                            @foreach($modulo as $mod)
                                <option value="{{$mod->id_modulo_referencia}}">{{$mod->n_modulo_referencia}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Servicio Taller/Actividad</label>
                        <select class="form-control" name="listaservicios" id="listaservicios" required>
                            <option value="">Seleccione...</option>

                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="">Nombre Taller/Actividad</label>
                        <input type="text" class="form-control" name="textNombreTaller" id="textNombreTaller" required pattern=".*[^ ].*" title="No puede estár en blanco">
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Tema general a desarrollar</label>
                        <textarea class="form-control" id="comment" name="comment" style="height: 108px; resize: none;" required></textarea>
                    </div>
                </div> <!-- div seleccione -->

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Institución responsable</label>
                        <input type="text" class="form-control" name="textInstitucionResponsable" id="textInstitucionResponsable" required>
                    </div>
                </div> <!-- div seleccione -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Cupos</label>
                        {{--input-block-level--}}
                        <input class="form-control" id="cuposTaller" name="cuposTaller" min="0" max="9999999999" type="number" required="" oninvalid="this.setCustomValidity('Debe ingresar la cantidad de cupos')" oninput="setCustomValidity('')">
                    </div>
                </div> <!-- div seleccione -->

                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Fecha de inicio</label>
                        <div class='input-group date'>
                            <input id='fechaInicioTaller' name='fechaInicioTaller' type='text' class="form-control" required pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$"/>
                            <span id="fechaInicioTallerIco" class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Fecha de término</label>
                        <div class='input-group date'>
                            <input id="fechaFinTaller" name="fechaFinTaller" type='text' class="form-control" required pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$"/>
                            <span id="fechaFinTallerIco" class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="fechaInicioTaller2" value="">
                <input type="hidden" name="fechaFinTaller2" value="">

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
        {{--well-sm--}}

        <h4>Listado de Talleres/Actividades</h4>
        <div class="form-inline">

            {{--<div class="col-lg-2 col-md-2 col-sm-1 col-xs-12">--}}

        </div>
        <br>
        <div  style="background:white ">

            <table id="dataTables_mtaller" class="display nowrap">
                <thead>
                <tr>
                    <th nowrap>ID</th>
                    <th nowrap>Nombre taller</th>
                    <th nowrap>ID oferta taller</th>
                    <th nowrap>Fecha inicio</th>
                    <th nowrap>Fecha termino</th>
                    <th nowrap>Tema general</th>
                    <th nowrap>Cupos&nbsp;</th>
                    <th nowrap>Institución responsable&nbsp;</th>
                    <th nowrap>Estado&nbsp;</th>
                    <th nowrap width="1%"></th>
                    <th nowrap width="1%">Opción</th>
                    <th nowrap width="1%"></th>

                </tr>
                </thead>
                <tbody>
                <?php
                function intToDate($int1) { // Convierte 20030201 => 01/02/2003
                    $dateAnno   = intval(intval($int1)/10000);   // 2003
                    $dateMesDia = intval($int1) - $dateAnno*10000;  // 201
                    $dateMes    = intval($dateMesDia/100);         // 2
                    $dateDia    = $dateMesDia - $dateMes*100;         // 1
                    if ($dateDia < 10){ $dateDia = "0" . $dateDia; }      // 01
                    if ($dateMes < 10){ $dateMes = "0" . $dateMes; }      // 02
                    return ($dateDia . "/" . $dateMes . "/" . $dateAnno); // 01/02/2003
                }
                ?>
                @foreach($registroversion as $registrov)
                    <tr>
                        <td class="hidden-xs hidden-sm">{{ $registrov->id_registro_version }}</td>
                        <td>{{ $registrov->n_registro_version }}</td>
                        <td class="hidden-xs hidden-sm">{{ $registrov->id_registro_taller }}</td>
                        <td>{{ intToDate($registrov->fecha_inicio) }}</td>
                        <td>{{ intToDate($registrov->fecha_termino) }}</td>
                        <td>{{ $registrov->tema_general}}</td>
                        <td>{{ $registrov->cupos}}
                        <td class="hidden-xs ">{{ $registrov->institucion_responsable }}</td>
                        <td>
                            @if($registrov->activo==='S')
                                <span class="hidden-xs hidden-sm">Activo</span>
                            @else
                                <span class="hidden-xs hidden-sm text-danger">No activo</span>
                            @endif
                        </td>
                        {{--<td>{{ $registrov->finalizado }}</td>--}}

                        <td>
                            @if($registrov->activo==='N')
                                <form id="activaForm{{$registrov->id_registro_version}}" name="activaForm" action="{{route('mtaller.activa',$registrov->id_registro_version )}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_registro_version" value="{{$registrov->id_registro_version}}">
                                    <input type="hidden" name="n_registro_version" value="{{$registrov->n_registro_version}}">
                                    <button class="btn btn-success hidden-xs hidden-sm hidden-md visible-lg" title="Permite ACTIVAR este taller">Activar</button>
                                </form>
                            @else
                                <form id="desactivaForm{{$registrov->id_registro_version}}" name="desactivaForm" action="{{route('mtaller.desactiva',$registrov->id_registro_version )}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_registro_version" value="{{$registrov->id_registro_version}}">
                                    <input type="hidden" name="n_registro_version" value="{{$registrov->n_registro_version}}">
                                    <button class="btn btn-default hidden-xs hidden-sm hidden-md visible-lg" title="Permite DESACTIVAR este taller">Desactivar</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if($registrov->finalizado==='N')
                                <form id="finalizaForm{{$registrov->id_registro_version}}" name="finalizaForm" action="{{route('mtaller.finaliza',$registrov->id_registro_version )}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_registro_version" value="{{$registrov->id_registro_version}}">
                                    <input type="hidden" name="n_registro_version" value="{{$registrov->n_registro_version}}">
                                    <button class="btn btn-default hidden-xs hidden-sm hidden-md visible-lg" title="Permite FINALIZAR este taller">Finalizar</button>
                                </form>
                            @else
                                <form id="reiniciaForm{{$registrov->id_registro_version}}" name="reiniciaForm" action="{{route('mtaller.reinicia',$registrov->id_registro_version )}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_registro_version" value="{{$registrov->id_registro_version}}">
                                    <input type="hidden" name="n_registro_version" value="{{$registrov->n_registro_version}}">
                                    <button class="btn btn-info hidden-xs hidden-sm hidden-md visible-lg" title="Permite REINICIAR este taller">Reiniciar</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <form id="eliminarForm{{$registrov->id_registro_version}}" name="eliminarForm" action="{{route('mtaller.destroy',$registrov->id_registro_version)}}" method="POST" style="margin-bottom: 0px">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id_registro_version" value="{{$registrov->id_registro_version}}">
                                <input type="hidden" name="n_registro_version" value="{{$registrov->n_registro_version}}">
                                <button class="btn btn-danger hidden-xs hidden-sm hidden-md visible-lg" title="Permite eliminar este taller de manera permanente">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!!  $registroversion->render() !!}
        </div>

    </div>
    {{--segundo well--}}
    <div id='divLoading' style='display:none; position:fixed;top:0px;left:0px; text-align:center;font-size:18px; height:100%;width:100%;color:#000; background-color:#fff;opacity:0.6; font-family: "proxima_novasemibold"; border:0px; text-align:center; text-decoration:none;color:#fff;z-index:99'>
        <img src='images/loading51.gif' border='0' style='position:fixed;top:50%;margin-top:-64px;left:50%;margin-left:-64px'>
    </div>

    <script>
        $('#listaservicios').animate({
            backgroundColor: '#CCCCCC',
            color: '#999999'
        }, 'fast');
        $("#listaservicios").prop('disabled', true);
        $('#listamodulos').change(function(){
            $('#listaservicios').animate({
                backgroundColor: '#CCCCCC',
                color: '#999999'
            }, 'fast');
            $("#listaservicios").prop('disabled', true);

            if ($(this).val() != "") {
                var ruta = "{{url('/listaservicio')}}";
                $.ajax({
                    url: ruta + '/' + $(this).val(),
//                    type: "POST",
//                    data: {reg : regid},
                    dataType: "json",
                    success: function (response) {
                        var cb_servicios_options = '<option value="">Seleccione...</option>';
                        $(response).each(function (index, element) {
                            cb_servicios_options += '<option value="' + element.id_servicio_referencia + '">' + element.n_servicio_referencia + '</option>';
                        });

                        $("#listaservicios").prop('disabled', false);
                        $('#listaservicios').empty().append($(cb_servicios_options)).animate({
                            backgroundColor: '#FFFFFF',
                            color: '#555555'
                        }, 'slow');
                    },
                    error: function (e) {
                        bootboxAlert("No se pudo cargar el listado de servicios");
                    }
                });
            }
        });

        $("[name='eliminarForm']").submit(function(e) {
            console.log("entro a eliminar antes de...");
            var currentForm = this;
            id_registro_version = currentForm.id_registro_version.value;
            n_registro_version = currentForm.n_registro_version.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea eliminar el taller ' + id_registro_version + ' "' + n_registro_version + '" y sus cursos asociados?',
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

        $("[name='activaForm']").submit(function(e) {
            var currentForm = this;
            id_registro_version = currentForm.id_registro_version.value;
            n_registro_version = currentForm.n_registro_version.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea activar el taller ' + id_registro_version + ' "' + n_registro_version + '"?',
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
            var currentForm = this;
            id_registro_version = currentForm.id_registro_version.value;
            n_registro_version = currentForm.n_registro_version.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea desactivar el taller ' + id_registro_version + ' "' + n_registro_version + '"?',
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

        $("[name='finalizaForm']").submit(function(e) {
            var currentForm = this;
            id_registro_version = currentForm.id_registro_version.value;
            n_registro_version = currentForm.n_registro_version.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea finalizar el taller ' + id_registro_version + ' "' + n_registro_version + '"?',
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

        $("[name='reiniciaForm']").submit(function(e) {
            var currentForm = this;
            id_registro_version = currentForm.id_registro_version.value;
            n_registro_version = currentForm.n_registro_version.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea reiniciar el taller ' + id_registro_version + ' "' + n_registro_version + '"?',
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

        $(document).ready(function () {

            $("#fechaInicioTaller").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-120:+0"
            });
            $("#fechaInicioTallerIco").click(function() {
                $("#fechaInicioTaller").focus();
            });

            $("#fechaFinTaller").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-120:+0"
            });
            $("#fechaFinTallerIco").click(function() {
                $("#fechaFinTaller").focus();
            });

        });

        tableData = $('#dataTables_mtaller').DataTable( {
            "scrollX": true,
            "columnDefs": [{
                "className": "dt-left",
                "targets": [ 1, 7, 11 ]
            },
            {
                "className": "dt-right",
                "targets": [ 9 ]
            },
            {
                "className": "dt-center",
                "targets": [ 0, 2, 3, 4, 5, 6, 8 ]
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
                        "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                    }
                },
                {
                    "text": '<span style="color:black">Exportar a PDF</span>',
                    "extend": 'pdf',
                    "title": 'Talleres-Actividades-' + fechaActual() + '-' + horaActual(),
//                     download: 'open',
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                    }
                },
                {
                    "text": '<span style="color:black">Imprimir</span>',
                    "extend": 'print',
                    "title": 'Talleres/Actividades ' + fechaActualText() + ' ' + horaActualText(),
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                    }
                }
                // 'print'
            ],
            info: false,
            ordering: false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
//            "paging": false
        } );

        function validateFormAgregar() {
            var textoError = "";
//            if (document.forms["agregarMtaller"]["listamodulos"].value == "") {
//                textoError += "<li> Debe seleccionar un módulo";
//            }
//            if (document.forms["agregarMtaller"]["listaservicios"].value == "") {
//                textoError += "<li> Debe seleccionar un servicio";
//            }
            if (document.forms["agregarMtaller"]["textNombreTaller"].value.trim() == "") {
                textoError += "<li> Debe escribir un nombre de Taller/Actividad";
            }
            if (document.forms["agregarMtaller"]["comment"].value.trim() == "") {
                textoError += "<li> Debe escribir un Tema general a desarrollar";
            }
            if (document.forms["agregarMtaller"]["textInstitucionResponsable"].value.trim() == "") {
                textoError += "<li> Debe escribir una Institución responsable";
            }
//            if (document.forms["agregarMtaller"]["cuposTaller"].value == "") {
//                textoError += "<li> Debe escribir la cantidad de cupos";
//            }
//            if (document.forms["agregarMtaller"]["fechaInicioTaller"].value == "") {
//                textoError += "<li> Debe seleccionar la fecha de inicio";
//            }
//            if (document.forms["agregarMtaller"]["fechaFinTaller"].value == "") {
//                textoError += "<li> Debe seleccionar la fecha de término";
//            }
            document.forms["agregarMtaller"]["fechaInicioTaller2"].value = dateToInt(document.forms["agregarMtaller"]["fechaInicioTaller"].value);
            document.forms["agregarMtaller"]["fechaFinTaller2"].value = dateToInt(document.forms["agregarMtaller"]["fechaFinTaller"].value);
            if (document.forms["agregarMtaller"]["fechaInicioTaller2"].value > document.forms["agregarMtaller"]["fechaFinTaller2"].value) {
                textoError += "<li> La fecha de termino debe ser mayor o igual a la de inicio";
            }
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
//                waitingDialog.hide();
        }

    </script>

@endsection
