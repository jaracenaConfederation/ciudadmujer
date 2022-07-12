<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Tmodulo_Referencia;


Route::get('/', function () {
    return view('indexhome');
});

Route::get('/login', function () {
    return view('login.login');
});



//Agendamiento

Route::get('/agenda', 'CitaAgendamientoController@index');

Route::get('/agendaadmin',function(){
    return view('magenda.agendaadmin');
});

Route::get('/agenda/{id}/{past}', 'CitaAgendamientoController@show');

Route::get('/agenda/{id}/{mod}/{serv}/{past}', 'CitaAgendamientoController@showFiltroUsuarias');

Route::get('/agendaMovil/{id}', 'CitaAgendamientoController@showMovil');

Route::get('/agenda_usuaria/{id}', 'RegistroUsuariaController@show')->name('agenda_busca_usuaria');

Route::get('/agenda_usuaria_get_idcm/{id}', 'RegistroUsuariaController@showidcm')->name('agenda_busca_usuaria');

Route::get('/listaservicio/{option}','TservicioReferenciaController@listado');

Route::get('/listaagendable/{option}','CitaAgendamientoController@listagend');

Route::get('/listaserprestadora/{idmodu}/{idserv}','CitaAgendamientoController@listservprestadora');

Route::get('/listaserprestadoracal/{idmodu}/{idserv}','CitaAgendamientoController@listservprestadora_cal');

Route::get('/listaserprestadoracalfiltro/{idmodu}/{idserv}/{idprest}','CitaAgendamientoController@listservprestadora_calfiltro');

Route::get('servicio_prestadora','CentrocmServicioPrestadoraController@servicio_prestadora');

Route::post('/agenda_nueva_cita','CitaAgendamientoController@store');

Route::post('/cancelar_cita','CitaAgendamientoController@destroy');

Route::post('/actualizar_cita','CitaAgendamientoController@update');

//Administracion citas
Route::get('/agendaadmincentro', 'AdminTCentroCMController@index')->name('agendaadmincentro');
Route::post('/agendaadmincentrostore', 'AdminTCentroCMController@store')->name('agendaadmincentro.store');
Route::post('/agendaadmincentroupdate/{id}', 'AdminTCentroCMController@update')->name('agendaadmincentro.update');
Route::delete('/agendaadmincentro/{id}', 'AdminTCentroCMController@destroy')->name('agendaadmincentro.destroy');

Route::get('/agendaadmincentrojornada', 'AdminTCentroJornadaCMController@index')->name('agendaadmincentrojornada');
Route::post('/agendaadmincentrojornadastore', 'AdminTCentroJornadaCMController@store')->name('agendaadmincentrojornada.store');
Route::post('/agendaadmincentrojornadaupdate/{id}', 'AdminTCentroJornadaCMController@update')->name('agendaadmincentrojornada.update');
Route::delete('/agendaadmincentrojornada/{id}', 'AdminTCentroJornadaCMController@destroy')->name('agendaadmincentrojornada.destroy');

Route::get('/agendaadmincentrojornadanoatiende', 'AdminTCentroJornadaNoAtiendeCMController@index')->name('agendaadmincentrojornadanoatiende');
Route::post('/agendaadmincentrojornadanoatiendestore', 'AdminTCentroJornadaNoAtiendeCMController@store')->name('agendaadmincentrojornadanoatiende.store');
Route::post('/agendaadmincentrojornadanoatiendeupdate/{id}', 'AdminTCentroJornadaNoAtiendeCMController@update')->name('agendaadmincentrojornadanoatiende.update');
Route::delete('/agendaadmincentrojornadanoatiende/{id}', 'AdminTCentroJornadaNoAtiendeCMController@destroy')->name('agendaadmincentrojornadanoatiende.destroy');

Route::get   ('/agendaadmincentrojornadaservicio',      'CentrocmJornadaServicioController@index')->name('agendaadmincentrojornadaservicio');
Route::post  ('/agendaadmincentrojornadaserviciostore',      'CentrocmJornadaServicioController@store')->name('agendaadmincentrojornadaservicio.store');
Route::post  ('/agendaadmincentrojornadaservicioupdate/{id}', 'CentrocmJornadaServicioController@update')->name('agendaadmincentrojornadaservicio.update');
Route::delete('/agendaadmincentrojornadaserviciodestroy/{id}', 'CentrocmJornadaServicioController@destroy')->name('agendaadmincentrojornadaservicio.destroy');


Route::get   ('/agendaadmincentrojornadaservicionoatiende',      'CentrocmJornadaServicioNoatiendeController@index')->name('agendaadmincentrojornadaservicio');
Route::post  ('/agendaadmincentrojornadaservicionoatiendestore',      'CentrocmJornadaServicioNoatiendeController@store')->name('agendaadmincentrojornadaservicionoatiende.store');
Route::post  ('/agendaadmincentrojornadaservicionoatiendeupdate/{id}', 'CentrocmJornadaServicioNoatiendeController@update')->name('agendaadmincentrojornadaservicio.update');
Route::delete('/agendaadmincentrojornadaservicionoatiendedestroy/{id}', 'CentrocmJornadaServicioNoatiendeController@destroy')->name('agendaadmincentrojornadaservicionoatiendedestroy');



Route::GET('/aacjs-showservicios/{idmod}', 'CentrocmJornadaServicioController@showservicios')->name('aacjs-showservicios');

Route::GET('/aacjs-showjornadas/{nomdia}', 'CentrocmJornadaServicioController@showjornadas')->name('aacjs-showjornadas');

Route::GET('/aacjs-showjornadasmantar/{id_cm_jorn}', 'CentrocmJornadaServicioController@showjornadasmananatarde')->name('aacjs-showjornadasmantar');

Route::POST('/storeserviciojornadacentro','CentrocmJornadaServicioController@storeserviciojornadacentro')->name('storeserviciojornadacentro');

Route::POST('/storeserviciojornadacentroporjornada','CentrocmJornadaServicioController@storeserviciojornadacentroporjornada')->name('storeserviciojornadacentroporjornada');

Route::delete('/deleteserviciojornadacentro/{id}','CentrocmJornadaServicioController@destroy')->name('deleteserviciojornadacentro');



Route::GET('/aacjst-index','CentrocmJornadaServicioTurnoController@index');//centrocm_jornada_servicio_turno

Route::get('/aacjst-dias_atencion/{id_servicio}','CentrocmJornadaServicioTurnoController@dias_atencion');//centrocm_jornada_servicio_turno

Route::get('/aacjst-dias_atencion_horas/{id_servicio}','CentrocmJornadaServicioTurnoController@dias_atencion_horas');//centrocm_jornada_servicio_turno


Route::POST('/aacjst-store','CentrocmJornadaServicioTurnoController@store')->name('aacjst-store');//centrocm_jornada_servicio_turno

Route::delete('/aacjst-destroy','CentrocmJornadaServicioTurnoController@destroy')->name('aacjst-destroy');//centrocm_jornada_servicio_turno


Route::GET('/aacjsprestadoras-index','CentrocmServicioPrestadoraController@index');

Route::POST('/aacjsprestadoras-store','CentrocmServicioPrestadoraController@store')->name('aacjsprestadoras-store');

Route::delete('/aacjsprestadoras-delete','CentrocmServicioPrestadoraController@destroy')->name('aacjsprestadoras-delete');


Route::POST('/aacspna-store','CentrocmServicioPrestadoraNoatiendeController@store')->name('aacspna-store');

Route::delete('/aacspna-delete','CentrocmServicioPrestadoraNoatiendeController@destroy')->name('aacspna-delete');


//Modulo Taller

Route::get('/otaller', 'OTallerController@index')->name('otaller');

Route::POST('/otallerstore', 'OTallerController@store')->name('otaller.store');

Route::POST('/otalleractiva{id}', 'OTallerController@activa')->name('otaller.activa');

Route::POST('/otallerdesactiva{id}', 'OTallerController@desactiva')->name('otaller.desactiva');

Route::delete('/otaller/{id}', 'OTallerController@destroy')->name('otaller.destroy');

Route::POST('/otallerupdate/{id}', 'OTallerController@update')->name('otaller.update');



Route::get('/mtaller', 'MTallerController@index')->name('mtaller');

Route::POST('/mtallerstore', 'MTallerController@store')->name('mtaller.store');

Route::POST('/mtalleractiva{id}', 'MTallerController@activa')->name('mtaller.activa');

Route::POST('/mtallerdesactiva{id}', 'MTallerController@desactiva')->name('mtaller.desactiva');

Route::POST('/mtallerreinicia{id}', 'MTallerController@reinicia')->name('mtaller.reinicia');

Route::POST('/mtallerfinaliza{id}', 'MTallerController@finaliza')->name('mtaller.finaliza');

Route::delete('/mtaller/{id}', 'MTallerController@destroy')->name('mtaller.destroy');

//Indicadores

Route::get('/indicador', 'IndicadorController@index')->name('indicadores');

Route::get('/rtaller', function () {
    return view('mtaller.rtaller');
});
Route::get('/etaller', function () {
    return view('mtaller.etaller');
});

Route::get('/gindicadores', function () {
    return view('mindicadores.gindicadores');
});
Route::get('/calendario', function () {
    return view('mtaller.calendario');
});

