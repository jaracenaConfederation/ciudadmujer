<html lang="es">
<head>

    <title>Ciudad Mujer @yield('titulo_pagina')</title>

    {{Html::style('libs/datepicker.1.5.0/bootstrap-datepicker.css')}}
    {{Html::style('libs/font-awesome/font-awesome.css')}}
    {{Html::script('libs/jquery/jquery-3.2.1.min.js')}}
    {{Html::script('libs/jquery/jquery-2.1.3.min.js')}}
    {{Html::script('libs/jquery/moment-2.9.0.min.js')}}
    {{Html::script('libs/fullcalendar/fullcalendar.js')}}
    {{Html::script('libs/fullcalendar/locale/es.js')}}
    {{Html::style('libs/bootstrap-3.3.7/css/bootstrap.min.css')}}
    {{Html::style('libs/fullcalendar/fullcalendar.css')}}

    {{Html::style('libs/jquery-ui/jquery-ui.css')}}
    {{Html::script('libs/jquery-ui/jquery-ui.js')}}

    {!!Html::script('libs/bootbox/bootbox.min.js')!!}
    {!!Html::script('libs/waitingDialog/waitingDialog.js')!!}
    {!!Html::script('libs/js/funciones.js')!!}

<!-- DataTables JavaScript 1.10.15 -->
    {!!Html::script('libs/dataTables/1.10.15/jquery.dataTables.js')!!}
    {!!Html::style('libs/dataTables/1.10.15/jquery.dataTables.min.css')!!}
    {!!Html::script('libs/dataTables/1.10.15/dataTables.bootstrap.js')!!}
    {!!Html::style('libs/dataTables/1.10.15/dataTables.bootstrap.min.css')!!}
<!-- fin DataTables JavaScript 1.10.15 -->

    {!!Html::script('libs/wickedpicker/wickedpicker.min.js')!!}
    {!!Html::style('libs/wickedpicker/wickedpicker.min.css')!!}

<!-- Botones xls-->
    {!!Html::style('libs/dataTables/buttons.dataTables.min.css')!!}

    {!!Html::script('libs/dataTables/dataTables.buttons.min.js')!!}
    {!!Html::script('libs/dataTables/buttons.flash.min.js')!!}
    {!!Html::script('libs/dataTables/jszip.min.js')!!}
    {!!Html::script('libs/dataTables/pdfmake.min.js')!!}
    {!!Html::script('libs/dataTables/vfs_fonts.js')!!}
    {!!Html::script('libs/dataTables/buttons.html5.min.js')!!}
    {!!Html::script('libs/dataTables/buttons.print.min.js')!!}
<!-- fin Botones xls-->

</head>
<body>
<div id="menuprincipal">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand visible-xs hidden-md hidden-sm visible-lg" href="{{url('/')}}">Agendamiento</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class=""><a href="{{url('/')}}">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Agendamiento de citas<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/agenda')}}">Agendamiento de Citas</a></li>
                            <li><a href="{{url('/agendaadmincentro')}}">Administración Horario de Centros</a></li>
                            <li><a href="{{url('/agendaadmincentrojornadaservicio')}}">Administración Horario de Servicios</a></li>
                            <li><a href="{{url('/aacjst-index')}}">Administración Horario de Turno</a></li>
                            <li><a href="{{url('/aacjst-index')}}">Administración Horario de Prestadoras</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Talleres y Actividades<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/otaller')}}">Mantenedor de ofertas de taller</a></li>
                            <li><a href="{{url('/mtaller')}}">Mantenedor de talleres</a></li>
                            <li><a href="{{url('/rtaller')}}">Asignación a talleres y sesiones</a></li>
                            <li><a href="{{url('/etaller')}}">Evaluar talleres</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Atención CCM<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/indicador')}}">Monitoreo y Seguimiento</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Monitoreo y Seguimiento<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/indicador')}}">Monitoreo y Seguimiento</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportabilidad<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/mantenedor_profesionales')}}">Administración de Centro</a></li>
                            <li><a href="{{url('#')}}">---</a></li>
                            <li><a href="{{url('#')}}">---</a></li>
                            <li><a href="{{url('#')}}">---</a></li>
                            <li><a href="{{url('#')}}">---</a></li>
                            <li><a href="{{url('#')}}">---</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</div>

@yield('content_home')

{{Html::script('libs/bootstrap-3.3.7/js/bootstrap.min.js')}}
{{Html::script('libs/datetimepicker/bootstrap-datetimepicker.js')}}



<script type="text/javascript">

    $(function () {

        $('#fecha1').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            locale:'es'
        });

        $('#fecha2').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            locale: 'es'
        });
        $("#fecha1").on("dp.change", function (e) {
            $('#fecha2').data("DateTimePicker").minDate(e.date);
        });
        $("#fecha2").on("dp.change", function (e) {
            $('#fecha1').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>


    </body>
</html>