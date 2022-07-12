


$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(function() {
    //Array para dar formato en español
    $.datepicker.regional['es'] =
        {
            closeText: 'Cerrar',
            prevText: 'Previo',
            nextText: 'Próximo',

            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                'Jul','Ago','Sep','Oct','Nov','Dic'],
            monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
            dateFormat: 'dd/mm/yy', firstDay: 1,
            initStatus: 'Selecciona la fecha', isRTL: false
        };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $( "#datepicker" ).datepicker({ minDate: "-1D", maxDate: "+1M +10D" });
});


function actualizaCombo(id ){

    alert("Esta en la funcion "+id);
}


function menuBarra(activo, page) { // inyecta html en div #menuBarra
    var menu1 = ""; var menu2 = ""; var menu3 = ""; var menu4 = "";
    var banner = "bn_gestion_taller.png";
    switch (activo) {
        case "1":
            menu1 = " class=\"active\""; break;
        case "2":
            menu2 = " class=\"active\""; break;
        case "3":
            menu3 = " class=\"active\""; break;
        case "4":
            menu4 = " class=\"active\""; break;
    }
    $('#menuBarra').html(
        "<div class=\"row\">\n" +
            "<img src=\"" + page + "/static/img/" + banner + "\" height=\"80\">\n" +
        "</div>\n" +
        "<div class=\"row\">\n" +
            "<div class=\"container\">\n" +
                "<div class=\"navbar\">\n" +
                    "<div class=\"navbar-inner\">\n" +
                        "<ul class=\"nav\">\n" +
                            "<li" + menu1 + "><a href=\"otaller\">Oferta de talleres</a></li>\n" +
                            "<li" + menu2 + "><a href=\"mtaller\">Administraci&oacute;n de talleres</a></li>\n" +
                            "<li" + menu3 + "><a href=\"rtaller\">Registro de asistencia</a></li>\n" +
                            "<li" + menu4 + "><a href=\"etaller\">Evaluaci&oacute;n de talleres</a></li>\n" +
                        "</ul>\n" +
                    "</div>\n" +
                "</div>\n" +
            "</div>");
}

function menuBarraIndicadores(activo, page) { // inyecta html en div #menuBarra
    var menu1 = ""; var menu2 = "";
    var banner = "bn_fortalecimiento.png";
    if (activo == "1") { menu1 = " class=\"active\""; }
    if (activo == "2") { menu2 = " class=\"active\""; }
    $('#menuBarra').html(
        "<div class=\"row\">\n" +
            "<img src=\"" + page + "/static/img/" + banner + "\" height=\"80\">\n" +
        "</div>\n" +
        "<div class=\"row\">\n" +
            "<div class=\"container\">\n" +
                "<div class=\"navbar\">\n" +
                    "<div class=\"navbar-inner\">\n" +
                        "<ul class=\"nav\">\n" +
                            "<li" + menu1 + "><a href=\"administracion\">Administracii&oacute;n de Indicadores</a></li>\n" +
                            "<li" + menu2 + "><a href=\"gestion\">Gesti&oacute;n de Indicadores</a></li>\n" +
                        "</ul>\n" +
                    "</div>\n" +
                "</div>\n" +
            "</div>");
}

function muestraAlert(strong, mensaje, tipo, fadeO, modal) { // inyecta html en div #DivAlerta
    console.log(tipo);
    if (tipo == null) tipo = "Success";
    $("#DivAlerta" + modal).html("<div class=\"alert alert-" + tipo + " alert-dismissable fade in\">\n" +
        "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>\n" +
        "<strong>" + strong + "</strong>" + mensaje + "</div>");
    if (fadeO){
        $("#DivAlerta" + modal).fadeOut(10000);
    }
}
function muestraAlertVerde(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "success", false, "");
    } else {                    muestraAlert(arguments[0], arguments[1], "success", false, ""); }
}
function muestraAlertRojo(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "danger", false, "");
    } else {                    muestraAlert(arguments[0], arguments[1], "danger", false, ""); }
}
function muestraAlertVerdeWell2(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "success", false, "Well2");
    } else {                    muestraAlert(arguments[0], arguments[1], "success", false, "Well2"); }
}
function muestraAlertRojoWell2(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "danger", false, "Well2");
    } else {                    muestraAlert(arguments[0], arguments[1], "danger", false, "Well2"); }
}
function muestraAlertVerdeWell3(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "success", false, "Well3");
    } else {                    muestraAlert(arguments[0], arguments[1], "success", false, "Well3"); }
}
function muestraAlertRojoWell3(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "danger", false, "Well3");
    } else {                    muestraAlert(arguments[0], arguments[1], "danger", false, "Well3"); }
}
function muestraAlertVerdeModal(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "success", false, "Modal");
    } else {                    muestraAlert(arguments[0], arguments[1], "success", false, "Modal"); }
}
function muestraAlertRojoModal(){
    if (arguments.length == 1){ muestraAlert("", arguments[0], "danger", false, "Modal");
    } else {                    muestraAlert(arguments[0], arguments[1], "danger", false, "Modal"); }
}
//    muestraAlert("", mensaje, "info", false, "");
//    muestraAlert("", mensaje, "warning", false, "");

function dateToInt(date1) { // Convierte 01/02/2003 => 20030201
    var dateArray = date1.split("/");
    return (parseInt(dateArray[0]) + parseInt(dateArray[1]) * 100 + parseInt(dateArray[2]) * 10000);
}

function formatearFechaNumero(fecha) { // 01/02/2017 -> 20170201
    var arrayFecha = fecha.split("/");
    var mes = arrayFecha[1]; //getMesFormato( parseInt(arrayFecha[1] ) );
    return arrayFecha[2] + "" + mes + "" + arrayFecha[0];
}

function formatearHoraNumero( horaminuto ) {
    var validHora = horaminuto.match(/(\d{1,2}):(\d{1,2})\s(AM|PM)/);
    if (validHora.length > 0) {
        console.log('valida Hora PM');
        if (validHora[3] == 'PM' && validHora[1] != 12) {
            hora=(parseInt(validHora[1]) + 12);
        } else {
            hora = validHora[1];
        }
    }
    return hora;
}

function formatearMinutoNumero( horaminuto ) {
    var validHora = horaminuto.match(/(\d{1,2}):(\d{1,2})\s(AM|PM)/);
    if (validHora.length > 0) {
        minuto = validHora[2];
    }
    return minuto;
}

function intToDate(int1) { // Convierte 20030201 => 01/02/2003
    var dateAnno   = parseInt(parseInt(int1)/10000);   // 2003
    var dateMesDia = parseInt(int1) - dateAnno*10000;  // 201
    var dateMes    = parseInt(dateMesDia/100);         // 2
    var dateDia    = dateMesDia - dateMes*100;         // 1
    if (dateDia < 10){ dateDia = "0" + dateDia; }      // 01
    if (dateMes < 10){ dateMes = "0" + dateMes; }      // 02
    return (dateDia + "/" + dateMes + "/" + dateAnno); // 01/02/2003
}

function horaToInt(hour1) { // Convierte 20:03 => 2003
    var horaArray = hour1.split(":");
    return (parseInt(horaArray[0]) * 100 + parseInt(horaArray[1]));
}

function intToHora(int1) { // Convierte 2003 => 20:03
    var minutos = int1 % 100; // 3
    var hora = parseInt(int1/100); // 20
    if (minutos < 10){ minutos = "0" + minutos; } // 20
    if (hora < 10)   { hora = "0" + hora; } // 03
    return (hora + ":" + minutos);
}

function horaToIntAMPM(hour1) { // Convierte 8:03 p.m. => 2003
    var pmamArray = hour1.split(" ");
    var horaArray = pmamArray[0].split(":");
    var pmInt = 0;
    if (pmamArray[1] == "p.m." && horaArray[0] != "12"){ pmInt = 12; }
    return ((parseInt(horaArray[0]) + pmInt) * 100 + parseInt(horaArray[1]));
}

function intToHoraAMPM(int1) { // Convierte 2003 => 8:03 p.m.
    var minutos = int1 % 100; // 3
    var hora = parseInt(int1/100); // 20
    var cola;
    if (hora < 12){ cola = "a.m.";
    }else{ cola = "p.m."; }
    if (hora > 12){ hora = hora - 12; }
    if (minutos < 10){ minutos = "0" + minutos; } // 03
    return (hora + ":" + minutos + " " + cola);
}
