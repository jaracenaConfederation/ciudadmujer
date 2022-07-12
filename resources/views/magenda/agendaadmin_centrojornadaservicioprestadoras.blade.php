@extends('layout.magendaly')

@section('barramenu')
    <li><a href="{{url('/agenda')}}">Agendamiento de Citas </a></li>
    <li><a href="{{url('/agendaadmincentro')}}">Horario de Centros</a></li>
    <li><a href="{{url('/agendaadmincentrojornadaservicio')}}">Horario de Servicios</a></li>
    <li><a href="{{url('/aacjst-index')}}">Horario de Turno</a></li>
    <li class="active"><a href="#">Horario de Prestadoras<span class="sr-only">(current)</span></a></li>
@endsection
@section('contenido')

    @include('fragment.info')
    @include('fragment.success')
    @include('fragment.error')

    <h3>Administrador del horario de las prestadoras de servicios de Ciudad Mujer </h3>
    <div class="well">

        <form action="{{route('aacjsprestadoras-store')}}" method="POST" name="aacjsprestadoras-store" onsubmit="return validateFormAgregarPrestadora()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-3 col-md-2 col-sm-7 col-xs-5">
                    <div class="form-group">
                        <label>Prestadora</label>
                        <select class="form-control" name="comboPrestadoras" id="comboPrestadoras" required>
                            <option value="0">Seleccione...</option>
                            @foreach($prestadoras_disponibles as $p)
                                <option value="{{$p->id_prestadora}}">{{$p->id_prestadora}}</option>
                            @endforeach
                        </select>

                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-7 col-xs-5">
                    <div class="form-group">
                        <label>Servicio</label>
                        <select class="form-control" name="comboServicios" id="comboServicios" required>
                            <option value="0">Seleccione...</option>
                            @foreach($listaservicios as $lis)
                                <option value="{{$lis->id_servicio_referencia}}">{{$lis->n_servicio_referencia}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-2 col-md-2 col-sm-7 col-xs-5">
                    <div class="form-group">
                        <label>Día y jornada</label>
                        <select class="form-control" name="comboDiasAtencion" id="comboDiasAtencion" required>
                            <option value="0">Seleccione...</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-2 col-md-2 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora inicio Jornada</label>
                        <input type="text" class="form-control" name="jornadaInicio" id="jornadaInicio" readonly>
                        <input type="hidden" name="horaLimiteInferior" id="horaLimiteInferior">


                    </div> <!-- div input -->
                </div>

                <div class="col-lg-2 col-md-2 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora termino Jornada</label>
                        <input type="text" class="form-control" name="jornadaTermino" id="jornadaTermino" readonly>
                        <input type="hidden" name="horaLimiteSuperior" id="horaLimiteSuperior">


                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora inicio</label>
                        <input type="text" class="form-control" name="textHoraInicio" id="textHoraInicio" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="textHoraTermino" id="textHoraTermino" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-4 col-md-4 col-sm-7 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button type="submit" id="submit" class="form-control btn btn-info" title="Permite agregar jornadas">Agregar</button>
                    </div>
                </div>

            </div>

        </form>

    </div>

    <div class="well" style="background-color: #FFFFFF">
        <h4>Lista de prestadoras y sus horarios</h4>
        <div style="background: white">

            <div >
                <table id="dataTables_prestadoras" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>Prestadora</th>
                        <th nowrap>Servicio</th>
                        <th nowrap>Día</th>
                        <th nowrap>Jornada</th>
                        <th nowrap>Hora inicio</th>
                        <th nowrap>Hora termino</th>
                        <th nowrap width="1%">Opciones</th>
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
                    @foreach($listaprestadoras as $listaprest)
                        <tr>
                            <td>{{$listaprest->id_prestadora}}</td>
                            <td>{{$listaprest->n_servicio_referencia}}</td>
                            <td>{{$listaprest->cjdia}}</td>
                            <td>{{$listaprest->n_jornada}}</td>
                            <td>{{$listaprest->csphora_inicio}}</td>
                            <td>{{$listaprest->csphora_termino}}</td>
                            <td>
                                <form id="eliminarPrestadora" name="eliminarPrestadora" action="{{route('aacjsprestadoras-delete',$listaprest->id_centrocm_servicio_prestadora)}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_csprestadora" value="{{$listaprest->id_centrocm_servicio_prestadora}}">
                                    <button class="btn btn-danger" title="Permite eliminar esta jornada no atiende de manera permanente">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <h3>Administración de las fechas que no atenderá una prestadora de servicios de Ciudad Mujer</h3>

    <div class="well">
        <form action="{{route('aacspna-store')}}" method="POST" name="agregarCentroJornadaNoAtiende">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                    <div class="form-group">
                        <label>Prestadora</label>
                        <select class="form-control" name="comboListaPrestadoras" id="comboListaPrestadoras" required>
                            <option value="0">Seleccione...</option>
                            @foreach($pres as $p)
                                <option value="{{$p->id_prestadora}}">{{$p->id_prestadora}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Fecha</label>
                        <div class='input-group date'>
                            <input id='cspnafecha' name='cspnafecha' type='text' class="form-control" required pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$"/>
                            <span id="cspnafechaico" class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="fechaNoAtiende2" value="">

                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora inicio</label>
                        <input type="text" class="form-control" name="cspnahora_inicio" id="cspnahora_inicio" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="cspnahora_termino" id="cspnahora_termino" required>
                    </div> <!-- div input -->
                </div>

                <div class="col-lg-9 col-md-7 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <input type="text" class="form-control" name="cspnaobservaciones" id="cspnaobservaciones" required>
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
        <h4>Lista de prestadoras y las fechas y horas que no atenderan</h4>
        <div style="background: white">
            <div >
                <table id="dataTables_ListaPrestadora" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>Prestadora</th>
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

                    @foreach($listaprestadorasnoatiende as $lpresta)
                        <tr>
                            <td>{{$lpresta->id_prestadora}}</td>
                            <td>{{intToDate($lpresta->cspnafecha)}}</td>
                            <td>{{$lpresta->cspnahora_inicio}}</td>
                            <td>{{$lpresta->cspnahora_termino}}</td>
                            <td>{{$lpresta->cspnaobservaciones}}</td>
                            <td></td>
                            <td>
                                <button class="btn btn-default" title="Permite editar esta jornada.">Editar</button>

                            </td>
                            <td>
                                <form id="eliminarFormPrestNoatiende" name="eliminarFormPrestNoatiende" action="{{route('aacspna-delete')}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_pres_noatiende" value="{{$lpresta->id_centrocm_servicio_prestadora_noatiende}}">
                                    <button class="btn btn-danger" title="Permite eliminar un turno de no atención de manera permanente.">Eliminar</button>
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

        $('#comboServicios').on('click', function(){
            var ruta= "{{url('/aacjst-dias_atencion')}}";
            ruta= ruta+'/'+$(this).val()

            if ($(this).val() != '0'){
                $.get(ruta,
                    function(data) {
                        var model = $('#comboDiasAtencion');
                        model.empty();
                        model.append("<option value='0'>Seleccione un Servicio...</option>");
                        $.each(data, function(index, element) {
                            model.append("<option value='"+ element.id_centrocm_jornada_servicio +"'>" + element.cjdia +' - '+element.n_jornada+ "</option>");
                        });
                    });
            }
        });

        $('#comboDiasAtencion').on('click', function(){
            var ruta= "{{url('/aacjst-dias_atencion_horas')}}";
            ruta= ruta+'/'+$(this).val()

            console.log('ruta:'+ruta);
            if ($(this).val() != '0'){

                $.get(ruta,function(data) {
                    $.each(data, function(index, element) {
                        $('#horaLimiteInferior').val(element.cjshora_inicio);
                        $('#horaLimiteSuperior').val(element.cjshora_termino);

                        $('#jornadaInicio').val(element.cjshora_inicio);
                        $('#jornadaTermino').val(element.cjshora_termino);
                    });

                    console.log('$(\'#horaLimiteInferior\').val(element.cjshora_inicio):'+ $('#horaLimiteInferior').val());
                    console.log('$(\'#horaLimiteInferior\').val(element.cjshora_inicio):'+ $('#horaLimiteSuperior').val());
                });
            }
        });

        var options = {
//            now: "00:00:00", //hh:mm 24 hour format only, defaults to current time
            twentyFour: true,  //Display 24 hour format, defaults to false
            upArrow: 'wickedpicker__controls__control-up',  //The up arrow class selector to use, for custom CSS
            downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
            close: 'wickedpicker__close', //The close class selector to use, for custom CSS
            hoverState: 'hover-state', //The hover state class to use, for custom CSS
            title: 'Hora', //The Wickedpicker's title,
            showSeconds: true, //Whether or not to show seconds,
            timeSeparator: ':', // The string to put in between hours and minutes (and seconds)
            secondsInterval: 1, //Change interval for seconds, defaults to 1,
            minutesInterval: 1, //Change interval for minutes, defaults to 1
            beforeShow: null, //A function to be called before the Wickedpicker is shown
            afterShow: null, //A function to be called after the Wickedpicker is closed/hidden
            show: null, //A function to be called when the Wickedpicker is shown
            clearable: false //Make the picker's input clearable (has clickable "x")
        };
        $('#textHoraInicio').wickedpicker({title:"Seleccione hora", now:"7:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
        $('#textHoraTermino').wickedpicker({title:"Seleccione hora", now:"16:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
        $('#cspnahora_inicio').wickedpicker({title:"Seleccione hora", now:"7:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
        $('#cspnahora_termino').wickedpicker({title:"Seleccione hora", now:"16:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});

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

        function diferenciaHoras(inicio, fin){
            var Hini = inicio.split(":");
            var Hfin = fin.split(":");
            var segIni = Hini[0]*60 + Hini[1]*60 + Hini[2];
            var segFin = Hfin[0]*60 + Hfin[1]*60 + Hfin[2];
            return (segFin - segIni);
        }

        function validateFormAgregarPrestadora() {


            var hcjs_inicio     = $('#horaLimiteInferior').val();
            var hcjs_termino    = $('#horaLimiteSuperior').val();


            var textoError = "";
            var hinicio  = $('#textHoraInicio').val()+':00';
            var htermino = $('#textHoraTermino').val()+':00';

            console.log('hcjs_inicio'+hcjs_inicio);
            console.log('hcjs_termino'+hcjs_termino);
            console.log('hinicio'+hinicio);
            console.log('htermino'+htermino);



            if($('#comboServicios').val()=='0'){
                textoError += "<li> Debe seleccionar un servicio";
            }

            if($('#comboDiasAtencion').val()=='0'){
                textoError += "<li> Debe seleccionar un día y jornada de atención";
            }

            if (hinicio >= htermino){
                textoError += "<li> La hora de inicio (" + hinicio + "), debe ser menor a la hora de termino (" + htermino + ").";
            }

            if (hinicio < hcjs_inicio){
                textoError += "<li> La hora de inicio debe ser mayor a las " + hcjs_inicio;
            }

            if (hinicio > hcjs_termino){
                textoError += "<li> La hora de inicio debe ser menor a las " + hcjs_termino;
            }

            if (htermino > hcjs_termino){
                textoError += "<li> La hora de término debe ser menor a las " + hcjs_termino;
            }

            if (htermino < hcjs_inicio){
                textoError += "<li> La hora de término debe ser mayor a las" + hcjs_inicio;
            }

            if (textoError != ""){
                bootboxAlert(textoError);
                return false;
            }
            waitingDialogo();
        }

        $(document).ready(function () {

            $("#cspnafecha").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-0:+1"
            });
            $("#cspnafechaico").click(function() {
                $("#cspnafecha").focus();
            });
        });

        ListaPrestadora = $('#dataTables_ListaPrestadora').DataTable( {
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
        tableDataPrestadoras = $('#dataTables_prestadoras').DataTable( {
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

    </script>

@endsection
