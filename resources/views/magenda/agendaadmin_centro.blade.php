@extends('layout.magendaly')

@section('barramenu')
    <li><a href="{{url('/agenda')}}">Agendamiento de Citas </a></li>
    <li class="active"><a href="#">Horarios de Centro<span class="sr-only">(current)</span></a></li>
    <li><a href="{{url('/agendaadmincentrojornadaservicio')}}">Horario de Servicios</a></li>
    <li><a href="{{url('/aacjst-index')}}">Horario de Turno</a></li>
    <li><a href="{{url('/aacjsprestadoras-index')}}">Horario de Prestadoras</a></li>
@endsection
@section('contenido')

    @include('fragment.info')
    @include('fragment.success')
    @include('fragment.error')

    <h3>Administración de las fechas que no atenderá el centro Ciudad Mujer</h3>
    <div class="well">
        <form action="{{route('agendaadmincentrojornadanoatiende.store')}}" method="POST" name="agregarCentroJornadaNoAtiende" onsubmit="return validateFormAgregarCentroJornadaNoAtiende()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                    <div class="form-group">
                        <label>Jornada CM</label>
                        <select class="form-control" name="comboJornadas" id="comboJornadas" required>
                            <option value="">Seleccione...</option>
                            @foreach($jornadas as $jor)
                                <option value="{{$jor->id_centrocm_jornada}}">{{$jor->centrocm->n_centrocm}} - {{ucfirst($jor->cjdia)}} - {{ucfirst($jor->n_jornada)}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Fecha</label>
                        <div class='input-group date'>
                            <input id='fechaNoAtiende' name='fechaNoAtiende' type='text' class="form-control" required pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$"/>
                            <span id="fechaNoAtiendeIco" class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="fechaNoAtiende2" value="">

                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora inicio</label>
                        <input type="text" class="form-control" name="textHoraInicio" id="textHoraInicio" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="textHoraTermino" id="textHoraTermino" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-9 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <input type="text" class="form-control" name="textObservaciones" id="textObservaciones" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button type="submit" id="submit" class="form-control btn btn-info" title="Permite agregar jornadas">Agregar</button>
                    </div>
                </div>

            </div>

        </form>
    </div>

    <div class="well" style="background-color: #FFFFFF">
        <h4>Catálogo de talleres disponibles en ciudad mujer</h4>
        <div style="background: white">

            <div >
                <table id="dataTables_centrosJornada_Noatiende" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>ID</th>
                        <th nowrap>Jornada CM</th>
                        <th nowrap>Fecha</th>
                        <th nowrap>Hora inicio</th>
                        <th nowrap>Hora termino</th>
                        <th nowrap>Observaciones</th>
                        <th nowrap width="1%">Opciones</th>
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
                    @foreach($registrocentrojornadanoatiende as $registrono)
                        <tr>
                            <td>{{$registrono->id_centrocm_jornada_noatiende}}</td>
                            <td>{{$registrono->centrocmjornada->centrocm->n_centrocm}} -
                                {{--{{$registrono->id_centrocm_jornada}}--}}
                                {{$registrono->centrocmjornada->cjdia}} - {{$registrono->centrocmjornada->n_jornada}}</td>
                            <td>{{intToDate($registrono->cjnafecha)}}</td>
                            <td>{{$registrono->cjnahora_inicio}}</td>
                            <td>{{$registrono->cjnahora_termino}}</td>
                            <td>{{$registrono->cjnaobservaciones}}</td>
                            <td><button class="btn btn-default" title="Permite editar esta jornada no atiende de manera permanente">Editar</button></td>
                            <td>
                                <form id="eliminarFormJornadaNoAtiende{{$registrono->id_centrocm_jornada_noatiende}}" name="eliminarFormJornadaNoAtiende" action="{{route('agendaadmincentrojornadanoatiende.destroy', $registrono->id_centrocm_jornada_noatiende)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_centrocm_jornada_noatiende" value="{{$registrono->id_centrocm_jornada_noatiende}}">
                                    <button class="btn btn-danger" title="Permite eliminar esta jornada no atiende de manera permanente">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!  $registrocentrojornadanoatiende->render() !!}
            </div>

        </div>

    </div>

<br>
    <h3>Administración de los horarios y de las jornadas del centro Ciudad Mujer</h3>

    <div class="well">

        <form action="{{route('agendaadmincentrojornada.store')}}" method="POST" name="agregarCentroJornada" onsubmit="return validateFormAgregarCentroJornada()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Centro CM</label>
                        <select class="form-control" name="comboCentro" id="comboCentro" required>
                            <option value="">Seleccione...</option>
                            @foreach($centros as $cen)
                                <option value="{{$cen->id_centrocm}}">{{$cen->n_centrocm}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Jornada</label>
                        <select class="form-control" name="comboJornada" id="comboJornada" required>
                            <option value="">Seleccione...</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                            <option value="unica">Unica</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Día</label>
                        <select class="form-control" name="comboDia" id="comboDia" required>
                            <option value="">Seleccione...</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miércoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sábado">Sábado</option>
                            <option value="domingo">Domingo</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label for="">Hora inicio</label>
                        <input type="text" class="form-control" name="textHoraIniciohjornada" id="textHoraIniciohjornada" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="textHoraTerminohjornada" id="textHoraTerminohjornada" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button type="submit" id="submit" class="form-control btn btn-info" title="Permite agregar jornadas">Agregar</button>
                    </div>
                </div>

            </div>

        </form>

    </div>

    <div class="well" style="background-color: #FFFFFF">
        <h4>Lista de las jornadas de atención de Ciudad Mujer</h4>
        <div style="background: white">

            <div >
                <table id="dataTables_centrosJornada" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>ID</th>
                        <th nowrap>Centro CM</th>
                        <th nowrap>Jornada</th>
                        <th nowrap>Día</th>
                        <th nowrap>Hora inicio</th>
                        <th nowrap>Hora termino</th>
                        <th nowrap width="1%">Opciones</th>
                        <th nowrap></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($registrocentrojornada as $registroj)
                        <tr>
                            <td>{{$registroj->id_centrocm_jornada}}</td>
                            <td>{{$registroj->centrocm->n_centrocm}}</td>
                            <td>{{ucfirst($registroj->n_jornada)}}</td>
                            <td>{{ucfirst($registroj->cjdia)}}</td>
                            <td>{{$registroj->cjhora_inicio}}</td>
                            <td>{{$registroj->cjhora_termino}}</td>
                            <td><button class="btn btn-default" title="Permite editar esta jornada de manera permanente">Editar</button></td>
                            <td>
                                <form id="eliminarFormJornada{{$registroj->id_centrocm_jornada}}" name="eliminarFormJornada" action="{{route('agendaadmincentrojornada.destroy', $registroj->id_centrocm_jornada)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_centrocm_jornada" value="{{$registroj->id_centrocm_jornada}}">
                                    <button class="btn btn-danger" title="Permite eliminar esta jornada de manera permanente">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!  $registrocentrojornada->render() !!}
            </div>

        </div>

    </div>
<br>
    <h3>Administración del nombre del centro Ciudad Mujer</h3>
    <div class="well">
        <form action="{{route('agendaadmincentro.store')}}" method="POST" name="agregarCentro" onsubmit="return validateFormAgregarCentro()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="form-group">
                        <label for="">Nombre del Centro Ciudad Mujer</label>
                        <input type="text" class="form-control" name="textNombreCentro" id="textNombreCentro" required>
                    </div> <!-- div input -->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button type="submit" id="submit" class="form-control btn btn-info" title="Permite agregar el centro">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="well" style="background-color: #FFFFFF">

        <h4>Catálogo de centro disponibles en ciudad mujer</h4>
        <div style="background: white">
            <div >
                <table id="dataTables_centros" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>ID</th>
                        <th nowrap>Centro</th>
                        <th nowrap width="1%">Opciones</th>
                        <th nowrap width="1%"></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($registrocentro as $registroc)
                        <tr>
                            <td>{{$registroc->id_centrocm}}</td>
                            <td>{{$registroc->n_centrocm}}</td>

                            <td><button onclick="modalEditarCentro('{{$registroc->id_centrocm}}','{{$registroc->n_centrocm}}')" class="btn btn-default" title="Permite editar el nombre del centro">Editar</button></td>
                            <td>
                                <form id="eliminarFormCentro{{$registroc->id_centrocm}}" name="eliminarFormCentro" action="{{route('agendaadmincentro.destroy', $registroc->id_centrocm)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_centrocm" value="{{$registroc->id_centrocm}}">
                                    <input type="hidden" name="n_centrocm" value="{{$registroc->n_centrocm}}">
                                    <button class="btn btn-danger" title="Permite eliminar este centro de manera permanente">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!  $registrocentro->render() !!}
            </div>

        </div>

    </div>

    <form id="updateCentroCmNombre" action="" method="POST" name="updateOtaller" onsubmit="return validateFormModalEditarCentro()">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="id_registro_taller" name="id_registro_taller">
        <div class="modal fade" id="modalEditarCentro" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar Nombre del Centro</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    <label for="">Nombre del centro ciudad mujer</label>
                                    <input type="text" class="form-control" name="textNombreCentroModal" id="textNombreCentroModal">
                                    <input type="hidden" name="textid_centrocm" >

                                </div> <!-- div input -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-info" title="Permite guardar el nuevo nombre del Centro Ciudad Mujer">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                <!-- Modal content-->
            </div>
        </div>
    </form>

    <script type="text/javascript">

        $("[name='eliminarFormCentro']").submit(function(e) {
            var currentForm = this;
            id_centrocm = currentForm.id_centrocm.value;
            n_centrocm = currentForm.n_centrocm.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea eliminar el centro ' + id_centrocm + ' "' + n_centrocm + '" y sus asociados?',
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

        function validateFormAgregarCentro() {
            var textoError = "";
            if (document.forms["agregarCentro"]["textNombreCentro"].value.trim() == "") {
                textoError += "<li> Debe escribir un nombre de Centro";
            }
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
//                waitingDialog.hide();
        }

        tableData = $('#dataTables_centros').DataTable( {
            "scrollX": true,
            "language": {
                "url": "json/Spanish.json"
            },
            dom: 'rt',
            "buttons": [],
            info: false,
            ordering: false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
        } );

        function modalEditarCentro(id, nombre) {
            $("#textid_centrocm").val(id);
            $("#textNombreCentroModal").val(nombre);
            $('#updateCentroCmNombre').attr('action', '/agendaadmincentroupdate/' + id);
            $("#modalEditarCentro").modal();
        }

        function validateFormModalEditarCentro() {

            var textoError = "";
            if (document.forms["updateCentroCmNombre"]["textNombreCentroModal"].value.trim() == "") {
                textoError += "<li> Debe escribir un nombre de Centro";
            }
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
        }

        tableData = $('#dataTables_centrosJornada').DataTable( {
            "scrollX": true,
            "columnDefs": [{
                "className": "dt-left",
                "targets": [ 0 ]
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
                        "columns": [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    "text": '<span style="color:black">Exportar a PDF</span>',
                    "extend": 'pdf',
                    "title": 'Talleres-Actividades-' + fechaActual() + '-' + horaActual(),
//                     download: 'open',
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    "text": '<span style="color:black">Imprimir</span>',
                    "extend": 'print',
                    "title": 'Talleres/Actividades ' + fechaActualText() + ' ' + horaActualText(),
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3, 4, 5 ]
                    }
                }
                // 'print'
            ],
            info: false,
            ordering: false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]

        } ); //centros_Jornadas

        function validateFormAgregarCentroJornada() {
            var textoError = "";
            if (diferenciaHoras(document.forms["agregarCentroJornada"]["textHoraInicio"].value, document.forms["agregarCentroJornada"]["textHoraTermino"].value) <= 0) {
                textoError += "<li> La hora de termino debe ser mayor a la inicial";
            }
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
        }

        function diferenciaHoras(inicio, fin){
            var Hini = inicio.split(":");
            var Hfin = fin.split(":");
            var segIni = Hini[0]*60 + Hini[1]*60 + Hini[2];
            var segFin = Hfin[0]*60 + Hfin[1]*60 + Hfin[2];
            return (segFin - segIni);
        }

        var options = {
            twentyFour: true,  //Display 24 hour format, defaults to false
            upArrow: 'wickedpicker__controls__control-up',  //The up arrow class selector to use, for custom CSS
            downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
            close: 'wickedpicker__close', //The close class selector to use, for custom CSS
            hoverState: 'hover-state', //The hover state class to use, for custom CSS
            title: 'Hora', //The Wickedpicker's title,
            showSeconds: false, //Whether or not to show seconds,
            timeSeparator: ':', // The string to put in between hours and minutes (and seconds)
            secondsInterval: 1, //Change interval for seconds, defaults to 1,
            minutesInterval: 1, //Change interval for minutes, defaults to 1
            beforeShow: null, //A function to be called before the Wickedpicker is shown
            afterShow: null, //A function to be called after the Wickedpicker is closed/hidden
            show: null, //A function to be called when the Wickedpicker is shown
            clearable: false //Make the picker's input clearable (has clickable "x")
        };

        $('#textHoraInicio').wickedpicker({now:'8:00:00',twentyFour: true, showSpaces: false,timeSeparator: ':'});
        $('#textHoraTermino').wickedpicker({now:'16:00:00',twentyFour: true, showSpaces: false,timeSeparator: ':'});

        $('#textHoraIniciohjornada').wickedpicker({now:'8:00:00',twentyFour: true, showSpaces: false,timeSeparator: ':'});
        $('#textHoraTerminohjornada').wickedpicker({now:'16:00:00',twentyFour: true, showSpaces: false,timeSeparator: ':'});

        $("[name='eliminarFormJornada']").submit(function(e) {
            var currentForm = this;
            id_centrocm_jornada = currentForm.id_centrocm_jornada.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea eliminar la jornada ID: ' + id_centrocm_jornada + '?',
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

        tableData = $('#dataTables_centrosJornada_Noatiende').DataTable( {
            "scrollX": true,
            "columnDefs": [{
                "className": "dt-left",
                "targets": [ 0 ]
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
                        "columns": [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    "text": '<span style="color:black">Exportar a PDF</span>',
                    "extend": 'pdf',
                    "title": 'Talleres-Actividades-' + fechaActual() + '-' + horaActual(),
//                     download: 'open',
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    "text": '<span style="color:black">Imprimir</span>',
                    "extend": 'print',
                    "title": 'Talleres/Actividades ' + fechaActualText() + ' ' + horaActualText(),
                    "exportOptions": {
                        "columns": [ 0, 1, 2, 3, 4, 5 ]
                    }
                }
                // 'print'
            ],
            info: false,
            ordering: false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
//            "paging": false
        } );

        $("[name='eliminarFormJornadaNoAtiende']").submit(function(e) {
            var currentForm = this;
            id_centrocm_jornada_noatiende = currentForm.id_centrocm_jornada_noatiende.value;
            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea eliminar la jornada que no atiende ID: ' + id_centrocm_jornada_noatiende + '?',
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

            $("#fechaNoAtiende").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-0:+1"
            });
            $("#fechaNoAtiendeIco").click(function() {
                $("#fechaNoAtiende").focus();
            });

        });

        function validateFormAgregarCentroJornadaNoAtiende() {
            var textoError = "";
            if (diferenciaHoras(document.forms["agregarCentroJornadaNoAtiende"]["textHoraInicio"].value, document.forms["agregarCentroJornadaNoAtiende"]["textHoraTermino"].value) <= 0) {
                textoError += "<li> La hora de termino debe ser mayor a la inicial";
            }
            document.forms["agregarCentroJornadaNoAtiende"]["fechaNoAtiende2"].value = dateToInt(document.forms["agregarCentroJornadaNoAtiende"]["fechaNoAtiende"].value);
            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
        }

    </script>

@endsection
