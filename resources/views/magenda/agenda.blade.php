@extends('layout.magendaly')
    @section('barramenu')
        <li class="active"><a href="#">Agendamiento de Citas <span class="sr-only">(current)</span></a></li>
        <li><a href="{{url('/agendaadmincentro')}}">Administración Módulos</a></li>

    @endsection
    @section('contenido')

        <div class="well well-sm">

            <h4><strong>Identificación de la Usuaria</strong></h4>

            <div class="col-lg-12">
                <div class="row" >
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 " style="padding-left: 2px;padding-right: 2px" >
                        {{ Form::text('id_cm', null, array('placeholder'=>'Id. Cm','class'=>'form-control','id'=>'id_cm')) }}
                    </div> <!-- div seleccione -->

                    <div class=" col-lg-3 col-md-2 col-sm-2 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        {{Form::text( 'numeroidentificacion', isset($registrousuaria[0]) ? $registrousuaria[0]->numero_identificacion : '',array('placeholder'=>'Nº Identificación','class'=>'form-control','id'=>'numeroidentificacion')) }}
                    </div> <!-- div seleccione -->

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        {{ Form::text('nombresapellidos', isset($registrousuaria[0]) ? $registrousuaria[0]->nombres.' '.$registrousuaria[0]->apellidos : '', array('placeholder' => 'Nombres/Apellidos','class' =>'form-control','id'=>'nombresapellidos')) }}
                    </div> <!-- div seleccione -->

                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        {{ Form::text('fnacimiento',isset($registrousuaria[0]) ? $registrousuaria[0]->fecha_nacimiento : '', array('placeholder' => 'F. Nacimiento','class' =>'form-control','id'=>'fechanacimiento')) }}
                    </div> <!-- div seleccione -->

                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        <button type="button" id="btnbuscar" class="form-control btn btn-success " title="">Buscar</button>
                    </div> <!-- div seleccione -->

                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12 " style="padding-left: 2px;padding-right: 2px">
                        <button type="button" id="btnlimpiar" class="form-control btn btn-primary " title="">Limpiar</button>
                    </div> <!-- div seleccione -->

                </div>{{--row--}}
                <div class="row" >
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 " style="padding-left: 2px;padding-right: 2px" >
                        {{Form::label('FS','Filtrar por servicio seleccionado:')}}
                        {{ Form::checkbox('filtroservicios','0',null,['class' => 'filtroservicios', 'id' => 'filtroservicios']) }}
                    </div> <!-- div seleccione -->
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 " style="padding-left: 2px;padding-right: 2px" >
                        {{Form::label('FS','Ver citas pasadas:')}}
                        {{ Form::checkbox('citaspasadas','0',null,['class' => 'citaspasadas', 'id' => 'citaspasadas']) }}
                    </div> <!-- div seleccione -->
                </div>
            </div>

            <div class="hidden-md hidden-sm hidden-xs visible-lg">
                  <br><br><br>
            </div>
{{--            {{ Form::open(array('url' => '#')) }}--}}
            <h4><strong>Identificación de la Prestadora</strong></h4>
            <div class="row">
                <div class="col-lg-12" >
                    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        {{ Form::select('listamodulos',$m,0,array('class'=>'form-control','id'=>'listamodulos')) }}
                    </div> <!-- div seleccione -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        {{ Form::select('listaservicios',['Seleccione servicio'],0,array('class'=>'form-control','id'=>'listaservicios'))}}
                    </div> <!-- div seleccione -->

                    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 2px;padding-right: 2px">
                        {{ Form::select('listaprestadoras',['Seleccione prestadora'],0,array('class'=>'form-control','id'=>'listaprestadoras')) }}
                    </div> <!-- div seleccione -->
                </div>
            </div>
        </div><!-- well -->

        <div class="panel panel-primary">
            <div class="row" >
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div ><span style="background-color:#ff0000;margin-left: 5px">&nbsp&nbsp&nbsp&nbsp&nbsp</span>Citas agendadas</div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div ><span style="background-color:#35682D">&nbsp&nbsp&nbsp&nbsp&nbsp</span>Citas disponibles</div>


                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div ><span style="background-color:#FFCCFF">&nbsp&nbsp&nbsp&nbsp&nbsp</span> Citas que no estan disponibles para agendar</div>

                </div>
            </div>
            <div class="panel-heading">
                Calendario de Asignación de Citas
            </div>
            <div class="panel-body" >
                <div id="calendar"></div>
            </div>
        </div>

        {{ Form::open(array('url' => '/agenda_nueva_cita','method'=>'POST','id'=>'nuevacita')) }}
        <div id="modal-agendamiento-nueva-cita" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4>AGENDAMIENTO DE NUEVA CITA</h4>

                    </div> {{-- modalheader --}}

                    <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    {{Form::label('idcm','Id CM:')}}
                                    {{Form::text('idcm',old('idcm'),array('class'=>'form-control','readonly'=>'readonly'))}}
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    {{Form::label('numeroidentificacion','Nº Identificación:')}}
                                    {{Form::text('numeroidentificacion',old('numeroidentificacion'),array('class'=>'form-control','readonly'=>'readonly'))}}
                                    {{ Form::hidden('id_cen_ser_prest', null, array('id' => 'id_cen_ser_prest')) }}
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    {{Form::label('nombreapellido','Nombre:')}}
                                    {{Form::text('nombreapellido',old('nombreapellido'),array('class'=>'form-control','readonly'=>'readonly'))}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    {{Form::label('servicio','Servicio:')}}
                                    {{Form::text('servicio',old('servicio'),array('class'=>'form-control','readonly'=>'readonly'))}}
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    {{Form::label('prestadora','Prestadora:')}}
                                    {{Form::text('prestadora',old('prestadora'),array('class'=>'form-control','readonly'=>'readonly'))}}
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('fecha','Fecha:')}}
                                {{Form::text('fecha',old('fecha'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('hora_inicio','Hora inicio:')}}
                                {{Form::text('hora_inicio',old('hora_inicio'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('hora_termino','Hora Termino:')}}
                                {{Form::text('hora_termino',old('hora_termino'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                {{Form::label('observaciones','Observaciones:')}}
                                {{Form::text('observaciones',old('observaciones'),['class'=>'form-control'])}}
                            </div>
                        </div>


                    </div> {{--modal-body--}}
                    <div class="modal-footer">

                        <button type="button" id="btnagendar" class="btn btn-success" data-dismiss="modal">Agendar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir sin Agendar</button>

                    </div> {{--modal-footer--}}
                </div> {{-- modal content --}}
            </div> {{-- modal-dialog --}}
        </div> {{-- responsive-modal --}}
        {{ Form::close() }}

        {{ Form::open(array('url' => '/cancelar_cita','method'=>'POST','id'=>'cancelarcita')) }}
        <div id="modal-agendamiento-editar-cita" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4>EDICION DE CITA AGENDADA</h4>

                    </div> {{-- modalheader --}}

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('idcm','Id CM:')}}
                                {{Form::text('idcm',old('idcm'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('numeroidentificacion','Nº Identificación:')}}
                                {{Form::text('numeroidentificacion',old('numeroidentificacion'),array('class'=>'form-control','readonly'=>'readonly'))}}
                                {{ Form::hidden('id_cit_agen', null, array('id' => 'id_cit_agen')) }}
                                {{ Form::hidden('id_cen_ser_prest', null, array('id' => 'id_cen_ser_prest')) }}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('nombreapellido','Nombre:')}}
                                {{Form::text('nombreapellido',old('nombreapellido'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                {{Form::label('servicio','Servicio:')}}
                                {{Form::text('servicio',old('servicio'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                {{Form::label('prestadora','Prestadora:')}}
                                {{Form::text('prestadora',old('prestadora'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('fecha','Fecha:')}}
                                {{Form::text('fecha',old('fecha'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('hora_inicio','Hora inicio:')}}
                                {{Form::text('hora_inicio',old('hora_inicio'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                {{Form::label('hora_termino','Hora Termino:')}}
                                {{Form::text('hora_termino',old('hora_termino'),array('class'=>'form-control','readonly'=>'readonly'))}}
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                {{Form::label('observaciones','Observaciones:')}}
                                {{Form::text('observaciones',old('observaciones'),['class'=>'form-control'])}}
                            </div>
                        </div>

                    </div> {{--modal-body--}}

                    <div class="modal-footer">
                        <button type="button" id="btnseleccionausuaria" class="btn btn-success" data-dismiss="modal">Seleccionar Usuaria</button>
                        <button type="button" id="btnactualizarcitar" class="btn btn-success" data-dismiss="modal">Actualizar</button>
                        <button type="button" id="btncancelarcitar" class="btn btn-danger"  data-dismiss="modal">Cancelar Cita</button>
                        <button type="button" id="btnsalir" class="btn btn-default" data-dismiss="modal">Salir sin guardar</button>

                    </div> {{--modal-footer--}}
                </div> {{-- modal content --}}
            </div> {{-- modal-dialog --}}
        </div> {{-- responsive-modal --}}
        {{ Form::close() }}

        <div id="modal-mensaje" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 ><span id="mensaje_respuesta"></span></h4>
                    </div> {{-- modalheader --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                    </div> {{--modal-footer--}}
                </div> {{-- modal content --}}
            </div> {{-- modal-dialog --}}
        </div>

    @endsection

    @section ('funciones');
       <script>
           window.onload=function(){
               var pos = window.name || 0;
               window.scrollTo(0,pos);
           }
           window.onunload=function(){
               window.name = self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
           }

           var todas_las_citas=[];
           var eventos_usuaria=[];
           var eventos_prestadoras=[];
           var busqueda_presionada = 0;

           $(document).ready(function(){

               renderizaCalendario([]);

                   $('#filtroservicios').on('change',function(){


                        if ( busqueda_presionada != 0) {
                           if (eventos_usuaria.length > 0) {

                               if ($('#listamodulos').val() != '0' && $('#listaservicios').val() != '0') {

                                   actualizar_eventos_usuarias(actualiza_filtro_servicios());
                               }
                           }else{
                               actualizar_eventos_usuarias(actualiza_filtro_servicios());
                           }

                        }else{
                           if ($('#listamodulos').val() != '0' && $('#listaservicios').val() != '0') {

                                if ( busqueda_presionada != 0){
                                   actualizar_eventos_usuarias(actualiza_filtro_servicios());
                                }
                           }
                        }
                   });

                   $('#id_cm').keypress(function(e){

                       if (e.keyCode==13){
                           $(this).blur();
                           $(this).focus();

                           busqueda_presionada = 1;

                           var ruta= "{{url('/agenda_usuaria')}}";
                           var ruta_citas_agendadas= "{{url('/agenda')}}";

                           ruta= ruta+'/'+$('#id_cm').val()

                           if ($('#id_cm').val()){
                               carga_usuaria(ruta);

                           }else{
                               var ni = $("#numeroidentificacion");
                               var na = $('#nombresapellidos');
                               var fn = $("#fechanacimiento");
                               ni.val(null);
                               na.val(null);
                               fn.val(null);
                           }
                           ruta_citas_agendadas = actualiza_filtro_servicios();

                           actualizar_eventos_usuarias(ruta_citas_agendadas);

                       }

                   });

                   $('#numeroidentificacion').keypress(function(e){

                       if (e.keyCode==13){
                           $(this).blur();
                           $(this).focus();

                           busqueda_presionada = 1;

                           var ruta= "{{url('/agenda_usuaria')}}";

                           var ruta_citas_agendadas= "{{url('/agenda')}}";
                           var id_usurecuperado;

                           var ruta_id="{{url('/agenda_usuaria_get_idcm')}}";
                           if ($('#numeroidentificacion').val()){

                               ruta_id=ruta_id+'/'+$('#numeroidentificacion').val();
                               carga_id_usuaria(ruta_id);

                           }else{
                               var ni = $("#id_cm");
                               var na = $('#nombresapellidos');
                               var fn = $("#fechanacimiento");
                               ni.val(null);
                               na.val(null);
                               fn.val(null);
                           }
                       }
                   });

                   $('#btnbuscar').on('click', function(){
                       busqueda_presionada = 1;

                       var ruta= "{{url('/agenda_usuaria')}}";
                       var ruta_citas_agendadas= "{{url('/agenda')}}";

                       ruta= ruta+'/'+$('#id_cm').val()
                       var ruta_id="{{url('/agenda_usuaria_get_idcm')}}";
                       if ($('#numeroidentificacion').val()){
                           ruta_id=ruta_id+'/'+$('#numeroidentificacion').val();

                           carga_id_usuaria(ruta_id);

                       }else{
                           if ($('#id_cm').val()){
                               carga_usuaria(ruta);

                           }else{
                               var ni = $("#numeroidentificacion");
                               var na = $('#nombresapellidos');
                               var fn = $("#fechanacimiento");
                               ni.val(null);
                               na.val(null);
                               fn.val(null);
                           }

                           ruta_citas_agendadas = actualiza_filtro_servicios();

                           actualizar_eventos_usuarias(ruta_citas_agendadas);

                       }


                   });//$('#btnbuscar').on('click', function(){

                   $('#listamodulos').on('change',function(){
                       var ruta= "{{url('/listaagendable')}}";
                       ruta= ruta+'/'+$(this).val()
                       $.get(ruta,
                           function(data) {
                               var model = $('#listaservicios');
                               model.empty();
                               model.append("<option value='0'>Seleccione un Servicio...</option>");
                               $.each(data, function(index, element) {
                                   model.append("<option value='"+ element.id_servicio_referencia +"'>" + element.n_servicio_referencia + "</option>");
                               });
                           });
                   });//$('#listamodulos').on('change',function(){

                   $('#listaservicios').on('change',function(){

                        var ruta_citas_disp= "{{url('/listaserprestadoracal')}}";
                        ruta_citas_disp= ruta_citas_disp+'/'+$('#listamodulos').val()+'/'+$(this).val();

                        var ruta= "{{url('/listaserprestadora')}}";
                        ruta= ruta+'/'+$('#listamodulos').val()+'/'+$(this).val();

                       $.get(ruta, function(data){
                               var model = $('#listaprestadoras');
                               model.empty();
                               model.append("<option value='-1'>Todas las prestadoras</option>");
                               $.each(data, function(index, element) {
                                   model.append("<option value='"+ element.id_prestadora +"'>" + element.id_prestadora + "</option>");
                               });
                           });

                       actualizar_eventos(ruta_citas_disp);

                       if ( busqueda_presionada != 0) {
                           if (eventos_usuaria.length > 0) {
                               actualizar_eventos_usuarias(actualiza_filtro_servicios());
                           }
                       }

               });//$('#listaservicios').on('change',function(){

                   $('#listaprestadoras').on('change',function(){
                       var ruta_citas_disp = "{{url('/listaserprestadoracalfiltro')}}";
                       ruta_citas_disp= ruta_citas_disp+'/'+$('#listamodulos').val()+'/'+$('#listaservicios').val()+'/'+$(this).val();
                       var ruta= "{{url('/listaserprestadora')}}";
                       ruta= ruta+'/'+$('#listamodulos').val()+'/'+$(this).val();

                       actualizar_eventos(ruta_citas_disp);
                   });

                   $(function(){

                   $.ajaxSetup({
                       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                   });
                   $('#btnagendar').click(function(event) {
                       event.preventDefault();
                       var formId = '#nuevacita';
                       $.ajax({
                           url: $(formId).attr('action'),
                           type: $(formId).attr('method'),
                           data: $(formId).serialize(),
                           dataType: 'html',
                           success: function(result){
                               if ($(formId).find("input:first-child").attr('value') == 'POST') {
                                   var $jsonObject = jQuery.parseJSON(result);
                                   $(location).attr('href',$jsonObject.url);
                               }
                               else{
                                   $(formId)[0].reset();
                                   $('#mensaje_respuesta').text('La cita se ha agendado correctamente');
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

//                                Se debe actualizar la lista de citas agendadas y las que estan por agendarse
                                   console.log('Ok');
                               }
                           },
                           error: function(){
                               $('#mensaje_respuesta').text('¡Lo Sentimos :(!.La cita no se ha agendado debido a un error inesperado');
                               $('#modal-mensaje').modal('show');
                               setTimeout(function() {
                                   $('#modal-mensaje').modal('hide');
                               },2500);
                               console.log('Error');
                           }
                       });
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
                                           }
                                           else{

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

                   $('#btnactualizarcitar').click(function(event) {

                           event.preventDefault();

                           var formId = '#cancelarcita';

                           $.ajax({
                               url: '{{url('/actualizar_cita')}}',
                               type: $(formId).attr('method'),
                               data: $(formId).serialize(),
                               dataType: 'html',
                               success: function(result){
                                   if ($(formId).find("input:first-child").attr('value') == 'POST') {
                                       var $jsonObject = jQuery.parseJSON(result);
                                       $(location).attr('href',$jsonObject.url);
                                   }
                                   else{
                                       $(formId)[0].reset();
                                       $('#mensaje_respuesta').text('La cita se Actualizado correctamente');

                                       $('#modal-mensaje').modal('show');
                                       setTimeout(function() {
                                           $('#modal-mensaje').modal('hide');
                                       },2500);

                                       //Actualiza eventos de usuaria

                                       actualizar_eventos_usuarias(actualiza_filtro_servicios());

                                       //Actualiza eventos disponibles

                                       if ($('#listaprestadoras').val()=='0'){


                                           var ruta_citas_disp= "{{url('/listaserprestadoracal')}}";
                                           ruta_citas_disp= ruta_citas_disp+'/'+$('#listamodulos').val()+'/'+$('#listaservicios').val();

                                       }else{

                                           var ruta_citas_disp = "{{url('/listaserprestadoracalfiltro')}}";
                                           ruta_citas_disp= ruta_citas_disp+'/'+$('#listamodulos').val()+'/'+$('#listaservicios').val()+'/'+$('#listaprestadoras').val();
                                       }

                                       if ($('#listaservicios').val()!='0' )
                                       {
                                           actualizar_eventos(ruta_citas_disp);
                                       }
                                       console.log('Ok');
                                   }
                               },
                               error: function(){
                                   $('#mensaje_respuesta').text('¡Lo Sentimos :(!.La cita NO se ha guardado debido a un error inesperado');
                                   $('#modal-mensaje').modal('show');
                                   setTimeout(function() {
                                       $('#modal-mensaje').modal('hide');
                                   },2500);

                                   console.log('Error');
                               }
                           });
                       });

                   $('#btnsalir').click(function(){
                       renderizaCalendario(todas_las_citas);
                   });
               });

                   $('#btnlimpiar').on('click', function(){
                   var id = $('#id_cm');
                   var ni = $("#numeroidentificacion");
                   var na = $('#nombresapellidos');
                   var fn = $("#fechanacimiento");
                   var fil= $('#filtroservicios');
                   busqueda_presionada = 0;
                   ruta_citas='';
                   id.val(null);
                   ni.val(null);
                   na.val(null);
                   fn.val(null);

                   todas_las_citas.length=0;
                   eventos_usuaria.length=0;
                   eventos_prestadoras.length=0;

                   todas_las_citas= $.merge(todas_las_citas,eventos_usuaria);
                   todas_las_citas= $.merge(todas_las_citas,eventos_prestadoras);

                   $('#listamodulos').val(0).attr('selected',true);

                       $('#listaservicios').empty();
                       $('#listaservicios').append("<option value='0'>Seleccione servicio</option>");

                       $('#listaprestadoras').empty();
                       $('#listaprestadoras').append("<option value='0'>Seleccione prestadora</option>");

                       renderizaCalendario(todas_las_citas);

               });//$('#btnlimpiar').on('click', function(){

                   $('#btnseleccionausuaria').on('click', function(){
                       $('#id_cm').val($('#modal-agendamiento-editar-cita #idcm').val());
                       var ruta= "{{url('/agenda_usuaria')}}";
                       ruta= ruta+'/'+$('#id_cm').val()
                       carga_usuaria(ruta);
                       actualizar_eventos_usuarias(actualiza_filtro_servicios());
                   });
           });

            function intToDate(int1) { // Convierte 20030201 => 01/02/2003
                var dateAnno   = parseInt(parseInt(int1)/10000);   // 2003
                var dateMesDia = parseInt(int1) - dateAnno*10000;  // 201
                var dateMes    = parseInt(dateMesDia/100);         // 2
                var dateDia    = dateMesDia - dateMes*100;         // 1
                if (dateDia < 10){ dateDia = "0" + dateDia; }      // 01
                if (dateMes < 10){ dateMes = "0" + dateMes; }      // 02
                return (dateDia + "/" + dateMes + "/" + dateAnno); // 01/02/2003
            }

            function renderizaCalendario(todosEventos){
                console.log('Se inicia la funcion renderizarCalendario');

                var view = $('#calendar').fullCalendar('getView');
                var moment = $('#calendar').fullCalendar('getDate');
                var name_calendar=view.name;

                if (name_calendar== null){
                    name_calendar= 'month';
                }
                $('#calendar').fullCalendar('destroy');
                $('#calendar').fullCalendar({
                    "header":{
                        "left":"prev,next today",
                        "center":"title",
                        "right":"listYear,month,agendaWeek,agendaDay",
                    },
                    "allDaySlot":false,
                    "eventLimit":false,
                    "editable":true,
                    "selectable":true,
                    "businessHours":true,
                    "firstDay":1,
                    "minTime":"08:00:00",
                    "maxTime":"19:00:00",
                    "scrollTime":"07:00:00",
                    "resourceEditable":true,
                    "lang": "es",
                    "aspectRatio":2,
                    "height": "auto",
                    "nowIndicator":true,
                    "defaultView":name_calendar,
                    "defaultDate": moment,
                    "hiddenDays":[0],
                    events:todosEventos,
                    eventClick:function(event,jsEvent,view){

                        var d_fecha = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                        var d_start = $.fullCalendar.moment(event.start).format('HH:mm');
                        var d_end = $.fullCalendar.moment(event.end).format('HH:mm');

                         if (event.id_csprest > 0){
                             if (event.marca_usuaria == '0'){

                                 cargaModalNuevo($('#id_cm').val(),$('#numeroidentificacion').val(),$('#nombresapellidos').val(),event.nom_servicio,event.id_prestadora,d_fecha,d_start,d_end,event.id_csprest);
                             }else{
                                 cargaModalEditar(event.idCm,event.idCitAge,event.n_identificacion,event.nombre,event.nom_servicio,event.id_prestadora,d_fecha,d_start,d_end,event.observac,event.id_csprest);
                             }
                         }else{

                             $('#mensaje_respuesta').text('No se puede agendar esta fecha y hora');
                             $('#modal-mensaje').modal('show');

                             setTimeout(function() {
                                 $('#modal-mensaje').modal('hide');

                             },2500);
                         }
                    },
                    eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ){

                        var dia_seleccionado= event.start.format('YYYY-MM-DD');
                        var hora_seleccinada_inicio= event.start.format('HH:mm:ss');
                        var hora_seleccinada_termino= event.end.format('HH:mm:ss');
                        var id_csprest= event.id_csprest;
                        var fecha_homologada= dia_seleccionado+' '+ hora_seleccinada_inicio;
                        var evento_hora = new Date(fecha_homologada).toJSON().slice(11,19);
                        var e_hora = evento_hora;

                        var hoy = new Date().toJSON().slice(0,10);
                        var hoy_hora = new Date().toJSON().slice(11,19);
                        var dia_semana = new Date(dia_seleccionado).getUTCDay();

                        var misma_hora=0;
                        var citas_diferente_hora=0;
                        var citas_misma_hora_dif_prestadora=0;
                        var id_cspres= null;

                        if ((dia_seleccionado <= hoy) && e_hora <= hoy_hora){
                            $('#mensaje_respuesta').text('¡Error!, No se puede seleccionar una cita para el pasado');
                            $('#modal-mensaje').modal('show');

                            setTimeout(function() {
                                $('#modal-mensaje').modal('hide');

                            },2500);
                            revertFunc();

                        }else{

                            if (dia_semana > 0 && dia_semana < 6){

                                var mensaje_servicio_equivocado;

                                $.each(eventos_prestadoras,function(index,contenido){

                                    var contenido_dia_start  = new Date(contenido.start).toJSON().slice(0,10);

                                    if (dia_seleccionado == contenido_dia_start){

                                        if ((contenido.id_cjservicio == event.id_cjservicio) && (contenido.id_prestadora == event.id_prestadora))
                                        {
                                            var contenido_hora = new Date(contenido.start).toJSON().slice(11,19);
                                            var evento_hora = new Date(fecha_homologada).toJSON().slice(11,19);

                                            if (contenido_hora == evento_hora){
                                                id_csprest= contenido.id_csprest;
                                                misma_hora ++;
                                            }else{
                                                if ((contenido.id_cjservicio == event.id_cjservicio)){
                                                    citas_diferente_hora++;
                                                }
                                            }
                                        }else{
                                            if ((contenido.id_cjservicio == event.id_cjservicio)){

                                                if (contenido_hora == evento_hora){
                                                    citas_misma_hora_dif_prestadora++;
                                                    mensaje_servicio_equivocado= 1;
                                                }
                                            }
                                        }
                                    }
                                });

                                if(misma_hora == 0){
                                    $('#mensaje_respuesta').text('¡Error!, No tenemos citas disponibles acorde a la selección.\n Compruebe que la cita a agendar corresponda con el mismo citerio en la Identificación de la Prestadora ');
                                    $('#modal-mensaje').modal('show');
                                    setTimeout(function() {
                                        $('#modal-mensaje').modal('hide');
                                    },10000);
                                    revertFunc();
                                }else{
                                    //Cuando encuentra una hora con el mismo horario y la misma prestadora
                                    cargaModalEditar(event.idCm,event.idCitAge,event.n_identificacion,event.nombre,event.nom_servicio,event.id_prestadora,dia_seleccionado,hora_seleccinada_inicio,hora_seleccinada_termino,event.observac,id_csprest);
                                }

                            }else{
                                $('#mensaje_respuesta').text('¡Error!, No se puede agendar en día no habil');
                                $('#modal-mensaje').modal('show');
                                setTimeout(function() {
                                    $('#modal-mensaje').modal('hide');
                                },2000);
                                revertFunc();
                            }
                        }
                    },
                    dayClick: function(date, jsEvent, view) {
                        var calendar = $('#calendar').fullCalendar('getCalendar');
                        var hoy = $('#calendar').fullCalendar('today');
                        var m = calendar.moment();

                        if (view.name=='month'){
                            $('#calendar').fullCalendar('changeView', 'agendaWeek', date.format());
                        }else{
                            if (view.name=='agendaWeek') {
                                $('#calendar').fullCalendar('changeView', 'agendaDay', date.format());
                            }
                        }
                    }
                }).fullCalendar("refetchEvents");

            }//function renderizaCalendario(todosEventos){

            function cargaModalNuevo (idCm,n_identificacion,nombre,nom_servicio,id_prestadora,d_fecha,d_start,d_end,id_csprest){

                if(idCm!=''){
                    $('#modal-agendamiento-nueva-cita #idcm').val(idCm);
                    $('#modal-agendamiento-nueva-cita #numeroidentificacion').val(n_identificacion);
                    $('#modal-agendamiento-nueva-cita #nombreapellido').val(nombre);
                    $('#modal-agendamiento-nueva-cita #servicio').val(nom_servicio);
                    $('#modal-agendamiento-nueva-cita #prestadora').val(id_prestadora);
                    $('#modal-agendamiento-nueva-cita #fecha').val(d_fecha);
                    $('#modal-agendamiento-nueva-cita #hora_inicio').val(d_start);
                    $('#modal-agendamiento-nueva-cita #hora_termino').val(d_end);
                    $('#modal-agendamiento-nueva-cita #id_cen_ser_prest').val(id_csprest);

                    $('#modal-agendamiento-nueva-cita').modal('show');
                }else{
                    $('#mensaje_respuesta').text('Necesita los datos de la usuaria para poder agendar');
                    $('#modal-mensaje').modal('show');
                    setTimeout(function() {
                        $('#modal-mensaje').modal('hide');
                    },2000);
                }
            }

            function cargaModalEditar(idCm,idCitAge,n_identificacion,nombre,nom_servicio,id_prestadora,d_fecha,d_start,d_end,observac,id_csprestadora){
               $('#modal-agendamiento-editar-cita #idcm').val(idCm);
               $('#modal-agendamiento-editar-cita #id_cit_agen').val(idCitAge);
               $('#modal-agendamiento-editar-cita #numeroidentificacion').val(n_identificacion);
               $('#modal-agendamiento-editar-cita #nombreapellido').val(nombre);
               $('#modal-agendamiento-editar-cita #servicio').val(nom_servicio);
               $('#modal-agendamiento-editar-cita #prestadora').val(id_prestadora);
               $('#modal-agendamiento-editar-cita #fecha').val(d_fecha);
               $('#modal-agendamiento-editar-cita #hora_inicio').val(d_start);
               $('#modal-agendamiento-editar-cita #hora_termino').val(d_end);
               $('#modal-agendamiento-editar-cita #observaciones').val(observac);
               $('#modal-agendamiento-editar-cita #id_cen_ser_prest').val(id_csprestadora);

               if ($('#id_cm').val()==''){
                   $('#btnseleccionausuaria').show();
               }else{
                   $('#btnseleccionausuaria').hide();
               }
               $('#modal-agendamiento-editar-cita').modal('show');
           } //function cargaModalEditar(idCm,idCitaAgen,n_identificacion,nombre,nom_servicio,id_prestadora,d_fecha,d_start,d_end,observac){

            function actualizar_eventos(ruta_citas_disp){
                $.get(ruta_citas_disp,function(data) {

                   eventos_prestadoras.length=0;
                   $.each(data, function(index, element) {
                       eventos_prestadoras.push({editable:false,title:element[0]+'\n'+element[1],start:element[2],end:element[3],color:element[4],nom_servicio:element[0],id_prestadora:element[1],marca_usuaria:'0',id_csprest:element[5],id_cjservicio:element[8]});
                   });
                   todas_las_citas.length=0;
                   todas_las_citas= $.merge(todas_las_citas,eventos_usuaria);
                   todas_las_citas= $.merge(todas_las_citas,eventos_prestadoras);

                   renderizaCalendario(todas_las_citas);
               });
            }

            function actualizar_eventos_usuarias(ruta_citas_agendadas){
               $.get(ruta_citas_agendadas,function(data) {
                   var eventos_usuaria_old = eventos_usuaria;
                   eventos_usuaria.length=0;
                   var diferencia=0;

                   if(data.length > 0){
                       data.forEach(function(dat, index) {
                           eventos_usuaria.push({durationEditable:false,idCitAge:dat.id_cita,idCm:dat.id_cm,title:dat.nombres+' '+ dat.apellidos+'\n '+dat.n_servicio_referencia+'-'+dat.id_prestadora,start:dat.fecha_cita+' '+dat.hora_inicio_cita,end :dat.fecha_cita+' '+dat.hora_termino_cita,color:'#ff0000',marca_usuaria:'1',id_usuaria:dat.id_usuaria, nom_servicio:dat.n_servicio_referencia, n_identificacion:dat.numero_identificacion,nombre:dat.nombres+' '+ dat.apellidos,id_prestadora:dat.id_prestadora, id_csprest:dat.id_centrocm_servicio_prestadora,observac:dat.observaciones,id_cjservicio:dat.id_servicio_referencia});
                       });
                       todas_las_citas.length=0;
                   }else {
                       eventos_usuaria.length=0;
                       todas_las_citas.length=0;
                   }

                   todas_las_citas= $.merge(todas_las_citas,eventos_usuaria);
                   todas_las_citas= $.merge(todas_las_citas,eventos_prestadoras);

                   renderizaCalendario(todas_las_citas);
               });//$.get(ruta_cita,function(data) {
           }

            function carga_usuaria(ruta){
               $.get(ruta, function (data) {
                   var ni = $("#numeroidentificacion");
                   var na = $('#nombresapellidos');
                   var fn = $("#fechanacimiento");
                   if (data.length>0) {
                       $.each(data, function (index, element) {
                           ni.val(element.numero_identificacion);
                           na.val(element.nombres + " " + element.apellidos);
                           fn.val(intToDate(element.fecha_nacimiento));
                       });
                   }else{
                       ni.val(null);
                       na.val(null);
                       fn.val(null);
                   }
               });
            }

           function carga_id_usuaria(ruta_id) {
               var ruta = "{{url('/agenda_usuaria')}}";
               $.get(ruta_id, function (data) {
                   if (data.length > 0) {
                       $.each(data, function (index, element) {
                            id_usurecuperado = element.id_cm;
                       });
                       ruta = ruta + '/' + id_usurecuperado;
                       if (id_usurecuperado) {
                           $("#id_cm").val(id_usurecuperado);
                           carga_usuaria(ruta);
                       }
                       else {
                           var ni = $("#numeroidentificacion");
                           var na = $('#nombresapellidos');
                           var fn = $("#fechanacimiento");
                           ni.val(null);
                           na.val(null);
                           fn.val(null);
                       }
                       ruta_citas_agendadas = actualiza_filtro_servicios();

                       actualizar_eventos_usuarias(ruta_citas_agendadas);

                   }
               });
           }

            function actualiza_filtro_servicios(){
                var ruta_citas_agendadas = "{{url('/agenda')}}";

                if ($('#id_cm').val()) {
                    ruta_citas_agendadas = ruta_citas_agendadas + '/' + $('#id_cm').val();

                } else {
                        ruta_citas_agendadas = ruta_citas_agendadas + '/' +'-1';
                }

                if ($('#filtroservicios').is(':checked')) {

                    if ($('#listamodulos').val() != '0' && $('#listaservicios').val() != '0') {

                        ruta_citas_agendadas = ruta_citas_agendadas + '/' + $('#listamodulos').val() + '/' + $('#listaservicios').val();

                    } else {
                        //console.log('NO Se filtra la busqueda');
                    }
                } else {


                }

                if ($('#citaspasadas').is(':checked')) {
                    ruta_citas_agendadas = ruta_citas_agendadas +'/past';
                }else{
                    ruta_citas_agendadas = ruta_citas_agendadas +'/nopast';
                }
                return ruta_citas_agendadas;
            }

       </script>
    @endsection