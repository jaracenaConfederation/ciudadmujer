/**
 * Created by Orlando on 20/10/2017.
 */

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

function waitingDialogo(){
    waitingDialog.show('Procesando...', {dialogSize: 'sm', progressType: 'warning'});
}

function waitingDialogo_2() {
    document.onkeypress = function(evt) {
        return false;
    };
    $("#divLoading").style.display = "block";
}

function bootboxAlert(text) {
    bootbox.alert({
        message: text,
        buttons: {
            ok: {
                label: 'Aceptar'
            }
        }
    });
}

var currentDate = new Date();

function fechaActual() {
    var diaActual = currentDate.getDate();
    var mesActual = currentDate.getMonth() + 1;
    var anoActual = currentDate.getFullYear();
    return anoActual * 10000 + mesActual * 100 + diaActual;
}

function fechaActualText() {
    var diaActual = currentDate.getDate();
    var mesActual = currentDate.getMonth() + 1;
    var anoActual = currentDate.getFullYear();
    var ceroEnDia = "";
    if (diaActual < 10) {
        ceroEnDia = "0";
    }
    var ceroEnMes = "";
    if (mesActual < 10) {
        ceroEnMes = "0";
    }
    return anoActual + '-' + ceroEnMes + mesActual + '-' + ceroEnDia + diaActual;
}

function horaActual() {
    var horaActual = currentDate.getHours();
    var minutoActual = currentDate.getMinutes();
    var ceroEnHora = "";
    if (horaActual < 10) {
        ceroEnHora = "0";
    }
    return ceroEnHora + (horaActual * 100 + minutoActual);
}

function horaActualText() {
    var horaActual = currentDate.getHours();
    var minutoActual = currentDate.getMinutes();
    var ceroEnHora = "";
    if (horaActual < 10) {
        ceroEnHora = "0";
    }
    var ceroEnMinuto = "";
    if (minutoActual < 10) {
        ceroEnMinuto = "0";
    }
    return ceroEnHora + horaActual + '.' + ceroEnMinuto + minutoActual;
}

function dateToInt(date1) { // Convierte 01/02/2003 => 20030201
    var dateArray = date1.split("/");
    return (parseInt(dateArray[0]) + parseInt(dateArray[1]) * 100 + parseInt(dateArray[2]) * 10000);
}

