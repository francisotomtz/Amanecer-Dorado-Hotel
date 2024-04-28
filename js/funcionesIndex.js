var fechaActual = new Date().toISOString().split('T')[0];

document.getElementById('fecha-llegada').min = fechaActual;
document.getElementById('fecha-salida').min = fechaActual;

function actualizarFechaSalidaMin() {
    var fechaLlegada = document.getElementById('fecha-llegada').value;
    document.getElementById('fecha-salida').min = fechaLlegada;
    deshabilitarFechasAnteriores();

    document.getElementById('fecha-salida').disabled = false;
}

function deshabilitarFechasAnteriores() {
    var fechaLlegada = new Date(document.getElementById('fecha-llegada').value);
    var fechaSalidaInput = document.getElementById('fecha-salida');
    var fechasSalidaOptions = fechaSalidaInput.querySelectorAll('option');

    fechasSalidaOptions.forEach(function (opcion) {
        opcion.disabled = false;
    });

    fechasSalidaOptions.forEach(function (opcion) {
        var fechaOpcion = new Date(opcion.value);
        if (fechaOpcion < fechaLlegada) {
            opcion.disabled = true;
        }
    });
}


function agendar() {
    var fechaLlegada = document.getElementById('fecha-llegada').value;
    var fechaSalida = document.getElementById('fecha-salida').value;
    var aux = "1";

    if (fechaLlegada === '' || fechaSalida === '') {
        alert('Por favor, selecciona ambas fechas.');
        return;
    }

    var fechaActual = new Date().toISOString().split('T')[0];

    if (fechaLlegada < fechaActual) {
        alert('La fecha de llegada no puede ser anterior a la fecha actual.');
        return;
    }

    if (fechaSalida <= fechaLlegada) {
        alert('La fecha de salida debe ser posterior a la fecha de llegada.');
        return;
    }

    if (fechaSalida === fechaLlegada) {
        alert('La fecha de salida no puede ser igual a la fecha de llegada.');
        return;
    }

    localStorage.setItem('fechaLlegada', fechaLlegada);
    localStorage.setItem('fechaSalida', fechaSalida);
    localStorage.setItem('aux', aux);

    window.location.href = 'http://localhost/Amanecer-Dorado-Hotel/reservas.php';

}