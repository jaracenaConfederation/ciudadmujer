@extends('layout.magendaly')

@section('barramenu')
    <li><a href="{{url('/agenda')}}">Agendamiento de Citas </a></li>
    <li><a href="{{url('/agendaadmincentro')}}">Horario de Centros</a></li>
    <li><a href="{{url('/agendaadmincentrojornadaservicio')}}">Horario de Servicios</a></li>
    <li class="active"><a href="#">Horario de Turno<span class="sr-only">(current)</span></a></li>
    <li><a href="{{url('/aacjsprestadoras-index')}}">Horario de Prestadoras</a></li>
@endsection
@section('contenido')

    @include('fragment.info')
    @include('fragment.success')
    @include('fragment.error')

    <h3>Administrador del horario de los turnos de los servicios de Ciudad Mujer</h3>
    <div class="well">

        <form action="{{route('aacjst-store')}}" method="POST" name="agregarturno" onsubmit="return validateFormAgregarturno()">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-5">
                    <div class="form-group">
                        <label>Servicio</label>
                        <select class="form-control" name="comboServicios" id="comboServicios" required>
                            <option value="0">Seleccione...</option>
                            @foreach($listaservicios as $jor)
                                <option value="{{$jor->id_servicio_referencia}}">{{$jor->n_servicio_referencia}}</option>
                            @endforeach
                        </select>
                    </div> <!-- div seleccione -->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-5">
                    <div class="form-group">
                        <label>Día y Jornada de Atención</label>
                        <select class="form-control" name="comboDiasAtencion" id="comboDiasAtencion" required>
                            <option value="0">Seleccione...</option>
                        </select>
                    </div> <!-- div seleccione -->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Hora inicio Jornada</label>
                        <input id='jornadaInicio' name='jornadaInicio' type='text' class="form-control" readonly />
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Hora termino Jornada</label>
                        <input id='jornadaTermino' name='jornadaTermino' type='text' class="form-control" readonly />
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="comment">Nombre del Turno</label>
                            <input id='nombreTurno' name='nombreTurno' type='text' class="form-control" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora inicio</label>
                        <input type="text" class="form-control" name="textHoraInicio" id="textHoraInicio" required>
                        <input type="hidden" name="horaLimiteInferior" id="horaLimiteInferior">
                    </div> <!-- div input -->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-7 col-xs-7">
                    <div class="form-group">
                        <label for="">Hora termino</label>
                        <input type="text" class="form-control" name="textHoraTermino" id="textHoraTermino" required>
                        <input type="hidden" name="horaLimiteSuperior" id="horaLimiteSuperior">
                    </div> <!-- div input -->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                    <div class="form-group">
                        <label class="control-label" for="comment">&nbsp;</label>
                        <button type="submit" id="submit" class="form-control btn btn-info" title="Permite agregar un nuevo turno">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="well" style="background-color: #FFFFFF">
        <h4>Lista de los servicios disponibles y sus respectivos turnos</h4>
        <div style="background: white">

            <div >
                <table id="dataTables_centrosJornada" class="display nowrap">
                    <thead>
                    <tr>
                        <th nowrap>Id Turno</th>
                        <th nowrap>Servicio</th>
                        <th nowrap>Día</th>
                        <th nowrap>Turno</th>
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
                    @foreach($registroturnos as $registrono)
                        <tr>
                            <td>{{$registrono->id_centrocm_jornada_servicio_turno}}</td>
                            <td>{{$registrono->n_servicio_referencia}}</td>
                            <td>{{$registrono->cjdia}}</td>
                            <td>{{$registrono->id_turno}}</td>
                            <td>{{$registrono->n_jornada}}</td>
                            <td>{{$registrono->cjsthora_inicio}}</td>
                            <td>{{$registrono->cjsthora_termino}}</td>

                            <td>
                                <form id="eliminarFormJornadaNoAtiende" name="eliminarFormJornadaNoAtiende" action="{{route('aacjst-destroy')}}" method="POST" style="margin-bottom: 0px">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_centrocm_jornada_servicio_turno" value="{{$registrono->id_centrocm_jornada_servicio_turno}}">
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

    <script type="text/javascript">


        $('#comboServicios').on('click', function(){
            var ruta= "{{url('/aacjst-dias_atencion')}}";
            ruta= ruta+'/'+$(this).val()

                if ($(this).val() != '0'){

                $.get(ruta,function(data) {
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
        $('#textHoraInicio').wickedpicker({title:"Seleccione hora",now:"7:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});
        $('#textHoraTermino').wickedpicker({title:"Seleccione hora",now:"16:00",twentyFour: true,showSpaces: false,timeSeparator: ':'});

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

        function validateFormAgregarturno() {


            var hcjs_inicio     = $('#horaLimiteInferior').val();
            var hcjs_termino    = $('#horaLimiteSuperior').val();


            var textoError = "";
            var hinicio  = $('#textHoraInicio').val()+':00';
            var htermino = $('#textHoraTermino').val()+':00';

            if($('#comboServicios').val()=='0'){
                textoError += "<li> Debe seleccionar un servicio";
            }

            if($('#comboDiasAtencion').val()=='0'){
                textoError += "<li> Debe seleccionar un día y jornada de atención";
            }

            if($('#nombreTurno').val()==''){
                textoError += "<li> Debe escribir el nombre del turno";
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

            $("#fechaNoAtiende").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-1:+2"
            });
            $("#fechaNoAtiendeIco").click(function() {
                $("#fechaNoAtiende").focus();
            });

        });

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
//            "paging": false
        } );

    </script>

@endsection
