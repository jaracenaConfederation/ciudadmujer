@extends('layout.magendaly')

@section('barramenu')
    <li><a href="{{url('/agenda')}}">Agendamiento de Citas </a></li>
    <li><a href="{{url('/agendaadmincentro')}}">Horarios de Centro</a></li>
    <li class="active"><a href="#">Horario de Servicios <span class="sr-only">(current)</span></a></li>
    <li><a href="{{url('/aacjst-index')}}">Horario de Turno</a></li>
    <li><a href="{{url('/aacjsprestadoras-index')}}">Horario de Prestadoras</a></li>

@endsection
@section('contenido')

    @include('fragment.info')
    @include('fragment.success')
    @include('fragment.error')

    <h3>Administración de servicios y sus horarios de atención en el Centro Ciudad Mujer</h3>
    <div class="well">
        <form action="{{route('storeserviciojornadacentro')}}" method="POST" name="agregatiempocomojornada" id="agregatiempocomojornada" onsubmit="return validateAgregarHorarioCentroJornada()">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Centro CM</label>
                        <select class="form-control" name="comboNombreCentro" id="comboNombreCentro" required>
                            <option value = "0" >Seleccione...</option>
                            @foreach($centrocm as $ccm)
                                <option value="{{$ccm->id_centrocm}}">{{$ccm->n_centrocm}}</option>
                            @endforeach

                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Modulos</label>
                        <select class="form-control" name="comboModulo" id="comboModulo" required>
                            <option value="0">Seleccione...</option>
                            @foreach($modulosdisponibles as $mod)
                                <option value="{{$mod->id_modulo_referencia}}">{{$mod->n_modulo_referencia}}</option>
                            @endforeach

                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Servicio</label>
                        <select class="form-control" name="comboServicios" id="comboServicios" required>
                            <option value="0">Seleccione...</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Usar el horario del centro?</label>
                        <select class="form-control" old="comboSiNoHorarioCentro" name="comboSiNoHorarioCentro" id="comboSiNoHorarioCentro" required>
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select>
                    </div> <!-- div seleccione -->

                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Día</label>
                        <select class="form-control" name="comboDia" id="comboDia" >
                            <option value="0">Seleccione...</option>">Seleccione...</option>
                            @foreach($centrocmdiasatencion as $dia)
                                <option value="{{$dia->cjdia}}">{{$dia->cjdia}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Jornada</label>
                        <select class="form-control" name="comboJornada" id="comboJornada" >
                            <option value="0">Seleccione...</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Usar horario de la jornada?</label>
                        <select class="form-control" name="combosinoJornada" id="combosinoJornada" >
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label for="">Hora inicio</label>
                        <input type="text" class="form-control" name="textHoraInicio" id="textHoraInicio" >
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="textHoraTermino" id="textHoraTermino" >
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button id="agregarhorarioservicio" class="form-control btn btn-info" title="Permite agregar jornadas">Agregar</button>
                    </div>
                </div>

            </div>

        </form>

    </div>

    <div class="well" style="background-color: #FFFFFF">
        <h4>Lista de servicios y sus horarios de atención en el Centro Ciudad Mujer</h4>
        <div style="background: white">
            <div >
                <table id="dataTables_centrosJornada" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>Centro CM</th>
                        <th nowrap>Servicio</th>
                        <th nowrap>Día</th>
                        <th nowrap>Jornada</th>
                        <th nowrap>Hora inicio</th>
                        <th nowrap>Hora termino</th>
                        <th nowrap >Opciones</th>
                        <th nowrap width="1%"></th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($centrocmjornada as $ccmjornada)
                        <tr>
                            <td>{{$ccmjornada->n_centrocm}}</td>
                            <td>{{$ccmjornada->n_servicio_referencia}}</td>
                            <td>{{$ccmjornada->cjdia}}</td>
                            <td>{{$ccmjornada->n_jornada}}</td>
                            <td>{{$ccmjornada->cjshora_inicio}}</td>
                            <td>{{$ccmjornada->cjshora_termino}}</td>
                            <td>
                                <button class="btn btn-default" title="Permite editar esta jornada.">Editar</button>

                            </td>
                            <td>
                                <form id="eliminarFormJornada" name="eliminarFormJornada" action="{{route('deleteserviciojornadacentro', $ccmjornada->id_centrocm_jornada_servicio)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_centrocm_jornada_servicio" value="{{$ccmjornada->id_centrocm_jornada_servicio}}">
                                    <input type="hidden" name="n_servicio_referencia" value="{{$ccmjornada->n_servicio_referencia}}">
                                    <input type="hidden" name="dia" value="{{$ccmjornada->cjdia}}">
                                    <input type="hidden" name="jornada" value="{{$ccmjornada->n_jornada}}">
                                    <button class="btn btn-danger" title="Permite eliminar esta jornada de manera permanente.">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{--{!!  $registrocentrojornada->render() !!}--}}
            </div>
        </div>
    </div>

    <h3>Administración de las fechas que no atenderá un servicio de Ciudad Mujer</h3>

    <div class="well">
        <form action="{{route('agendaadmincentrojornadaservicionoatiende.store')}}" method="POST" name="agregarCentroJornadaNoAtiende">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                    <div class="form-group">
                        <label>Servicio CM</label>
                        <select class="form-control" name="comboListaServicios" id="comboListaServicios" required>
                            <option value="">Seleccione...</option>
                            @foreach($servicio_noatiende as $jor)
                                <option value="{{$jor->id_servicio_referencia}}">{{$jor->n_servicio_referencia}}</option>
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
                        <input type="text" class="form-control" name="textHoraInicioNoAtiende" id="textHoraInicioNoAtiende" required>
                        <input type="hidden" name="horaLimiteInferior" id="horaLimiteInferior">
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="textHoraTerminoNoAtiende" id="textHoraTerminoNoAtiende" required>
                        <input type="hidden" name="horaLimiteSuperior" id="horaLimiteSuperior">
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-9 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <input type="text" class="form-control" name="textObservacionesnoAtiende" id="textObservacionesnoAtiende" required>
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
        <h4>Lista de servicios y las fechas y horas que no atenderan</h4>
        <div style="background: white">
            <div >
                <table id="dataTables_centrosJornada2" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>Servicio</th>
                        <th nowrap>Fecha</th>
                        <th nowrap>Hora Inicio</th>
                        <th nowrap>Hora Termino</th>
                        <th nowrap>Observaciones</th>
                        <th nowrap></th>
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
                    @foreach($servicio_noatiende_lista as $snal)
                        <tr>
                            <td>{{$snal->n_servicio_referencia}}</td>
                            <td>{{intToDate($snal->cjsnafecha)}}</td>
                            <td>{{$snal->cjsnahora_inicio}}</td>
                            <td>{{$snal->cjsnahora_termino}}</td>
                            <td>{{$snal->cjsnaobservaciones}}</td>
                            <td></td>
                            <td>
                                <button class="btn btn-default" title="Permite editar esta jornada.">Editar</button>

                            </td>
                            <td>
                                <form id="eliminarFormJornadaservicio" name="eliminarFormJornadaservicio" action="{{route('agendaadmincentrojornadaservicionoatiendedestroy', $snal->id_centrocm_jornada_servicio_noatiende)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" title="Permite eliminar esta jornada de manera permanente.">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--{!!  $registrocentrojornada->render() !!}--}}
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var options = {
//            now: "00:00:00", //hh:mm 24 hour format only, defaults to current time
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

         $('#textHoraInicio').wickedpicker({title:"Seleccione hora",now:"7:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
         $('#textHoraTermino').wickedpicker({title:"Seleccione hora",now:"16:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
         $('#textHoraInicioNoAtiende').wickedpicker({title:"Seleccione hora",now:"7:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
         $('#textHoraTerminoNoAtiende').wickedpicker({title:"Seleccione hora",now:"16:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});

         $("[name='eliminarFormJornada']").submit(function(e) {
            var currentForm = this;
            id_centrocm_jornada_servicio = currentForm.id_centrocm_jornada_servicio.value;
            n_servicio_referencia = currentForm.n_servicio_referencia.value;
            dia = currentForm.dia.value;
            jornada = currentForm.jornada.value;

            e.preventDefault();
            bootbox.confirm({
                message: '¿Está seguro que desea eliminar el servicio "'+ n_servicio_referencia+ '" para el día "' + dia + '" en la '+jornada+'?',
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
//                        waitingDialogo();
                    }
                }
            });
        });

        $("#fechaNoAtiende").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-0:+1"
        });

        $("#fechaNoAtiendeIco").click(function() {
            $("#fechaNoAtiende").focus();
        });

        function diferenciaHoras(inicio, fin){
            var Hini = inicio.split(":");
            var Hfin = fin.split(":");
            var segIni = Hini[0]*60 + Hini[1]*60 + Hini[2];
            var segFin = Hfin[0]*60 + Hfin[1]*60 + Hfin[2];
            return (segFin - segIni);
        }

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



        tableData= $('#dataTables_centrosJornada').DataTable( {
            "scrollX": true,
            "columnDefs": [{
                "className": "dt-left",
                "targets": [ 0 ],
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
        });

        tableData2= $('#dataTables_centrosJornada2').DataTable( {
            "scrollX": true,
            "columnDefs": [{
                "className": "dt-left",
                "targets": [ 0 ],
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
        });

        $('#comboModulo').on('click', function(){

            var ruta= "{{url('/aacjs-showservicios')}}";
            ruta= ruta+'/'+$(this).val()

            if ($(this).val() != '0'){
                $.get(ruta,
                    function(data) {
                        var model = $('#comboServicios');
                        model.empty();
                        model.append("<option value='0'>Seleccione un Servicio...</option>");
                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id_servicio_referencia +"'>" + element.n_servicio_referencia + "</option>");
                        });
                    });
            }
        });


        $('#comboDia').on('click', function(){
            var ruta= "{{url('/aacjs-showjornadas')}}";
            ruta= ruta+'/'+$(this).val();
            if ($(this).val() != '0'){
                $.get(ruta,
                    function(data) {
                        var model = $('#comboJornada');

                        model.empty();
                        model.append("<option value='0'>Seleccione una Jornada...</option>");
                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id_centrocm_jornada +"'>" + element.n_jornada + "</option>");


                        });
                    });
            }
        });

        $('#comboJornada').on('click', function(){

            var ruta= "{{url('/aacjs-showjornadasmantar')}}";
            ruta= ruta+'/'+$(this).val()

            if ($(this).val() != '0'){
                $.get(ruta,
                    function(data) {
                        $.each(data, function(index, element) {
                            console.log('element.cjhora_inicio:'+ element.cjhora_inicio + ' - element.cjhora_termino: '+ element.cjhora_termino);
                            $('#horaLimiteInferior').val(element.cjhora_inicio);
                            $('#horaLimiteSuperior').val(element.cjhora_termino);
                        });
                    });
            }
        });


        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            $('#btncancelarcitar').click(function(event) {
                event.preventDefault();
                var formId = '#cancelarcita';
                bootbox.confirm({
                    message: '¿Está seguro que desea eliminar la cita ?',
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
                            $.ajax({
                                url: $(formId).attr('action'),
                                type: $(formId).attr('method'),
                                data: $(formId).serialize(),
                                dataType: 'html',
                                success: function(result){
                                    if ($(formId).find("input:first-child").attr('value') == 'POST') {
                                        var $jsonObject = jQuery.parseJSON(result);
                                        $(location).attr('href',$jsonObject.url);
                                        console.log('$jsonObject.url');
                                    }
                                    else{
                                        console.log('{{url('/cancelar_cita')}}')
                                        $(formId)[0].reset();
                                        $('#mensaje_respuesta').text('La cita se ha cancelado correctamente');
                                        $('#modal-mensaje').modal('show');
                                        setTimeout(function() {
                                            $('#modal-mensaje').modal('hide');
                                        },2500);
                                        //Actualiza eventos de usuaria
                                        actualizar_eventos_usuarias(actualiza_filtro_servicios());
                                        //Actualiza eventos disponibles
                                        if ($('#listaprestadoras').val()==''){
                                            var ruta_citas_disp= "{{url('/listaserprestadoracal')}}";
                                            ruta_citas_disp= ruta_citas_disp+'/'+$('#listamodulos').val()+'/'+$('#listaservicios').val();
                                        }else{
                                            var ruta_citas_disp = "{{url('/listaserprestadoracalfiltro')}}";
                                            ruta_citas_disp= ruta_citas_disp+'/'+$('#listamodulos').val()+'/'+$('#listaservicios').val()+'/'+$('#listaprestadoras').val();
                                        }
                                        actualizar_eventos(ruta_citas_disp);
                                        console.log('Ok');
                                    }
                                },
                                error: function(){
                                    $('#mensaje_respuesta').text('¡Lo Sentimos :(!.La cita no se ha guardado debido a un error inesperado');
                                    $('#modal-mensaje').modal('show');
                                    setTimeout(function() {
                                        $('#modal-mensaje').modal('hide');
                                    },2500);
                                    console.log('Error');
                                }
                            });
                        }
                    }
                });
            });
        });

        function validateAgregarHorarioCentroJornada() {
            var textoError = "";
            console.log('$(#comboNombreCentro).val(): ' + $('#comboNombreCentro').val());
            if ($('#comboSiNoHorarioCentro').val()=='si'){
                            if ($('#comboNombreCentro').val() == '0'){
                                textoError += "<li> Debe seleccionar el nombre del centro</li>";
                            }
                            console.log('$(\'#comboModulo\').val(): ' + $('#comboModulo').val());
                            if ($('#comboModulo').val()=='0'){
                                textoError += "<li> Debe seleccionar un módulo</li>";
                            }
                            console.log('$(\'#comboServicios\').val(): ' + $('#comboServicios').val());
                            if($('#comboServicios').val()=='0'){
                                textoError += "<li> Debe seleccionar un servicio</li>";
                            }
            }else{
                console.log('#comboNombreCentro).val(): ' + $('#comboNombreCentro').val());
                if ($('#comboNombreCentro').val() == '0'){
                    textoError += "<li> Debe seleccionar el nombre del centro</li>";
                }
                console.log('$(\'#comboModulo\').val(): ' + $('#comboModulo').val());

                if ($('#comboModulo').val()=='0'){
                    textoError += "<li> Debe seleccionar un módulo</li>";
                }

                console.log('$(\'#comboServicios\').val(): ' + $('#comboServicios').val());
                if($('#comboServicios').val()=='0'){
                    textoError += "<li> Debe seleccionar un servicio</li>";
                }

                if ($('#comboDia').val()=='0'){
                    textoError += "<li> Debe seleccionar un día</li>";
                }

                console.log('$(\'#comboServicios\').val(): ' + $('#comboServicios').val());
                if($('#comboJornada').val()=='0'){
                    textoError += "<li> Debe seleccionar una jornada</li>";
                }

                var hora_inicio_selec       =  $('#textHoraInicio').val()+':00';
                var hora_termino_selec      =  $('#textHoraTermino').val()+':00';

                var hora_inicio_jornada     = $('#horaLimiteInferior').val();
                var hora_termino_jornada    = $('#horaLimiteSuperior').val();


                if( hora_inicio_selec < hora_inicio_jornada ){

                    console.log('La hora de inicio seleccioada es menor a la hora de inicio de la jornada')
                    textoError += "<li> Error en el Horario de la jornada de inicio. Debe ser mayor a las "+ hora_inicio_jornada +"</li>";
                }

                if( hora_inicio_selec >= hora_termino_jornada ){

                    console.log('La hora de inicio debe ser menor a la hora de inicio ')
                    textoError += "<li> La hora de Inicio debe ser menor a la hora de Termino de la Jornada, que es a las "+ hora_termino_jornada +"</li>";
                }

                if( hora_termino_selec > hora_termino_jornada ){

                    console.log('La hora de Termino debe ser menor que las s menor a la hora de inicio de la jornada')
                    textoError += "<li> Error en el Horario de la jornada de Termino. Debe ser menor a las "+ hora_termino_jornada +"</li>";
                }

                if( hora_termino_selec < hora_inicio_jornada ){

                    console.log('La hora de Termino debe ser menor que las s menor a la hora de inicio de la jornada')
                    textoError += "<li> Error en el Horario de la jornada de Termino. Debe ser mayor a las "+ hora_inicio_jornada +"</li>";
                }

                if( hora_inicio_selec >= hora_termino_selec ){

                    console.log('La hora de inicio debe ser menor a la hora de inicio ')
                    textoError += "<li> La hora de Inicio debe ser menor a la hora de Termino </li>";
                }

            }

            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
        }
    </script>

@endsection
