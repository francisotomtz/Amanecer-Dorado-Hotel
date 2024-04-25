var fechaLlegadaStored = localStorage.getItem('fechaLlegada');
var fechaSalidaStored = localStorage.getItem('fechaSalida');
var auxStored = localStorage.getItem('aux');

var fechaActual = new Date().toISOString().split('T')[0];

document.getElementById('fecha-llegada').min = fechaActual;
document.getElementById('fecha-salida').min = fechaActual;

document.getElementById('fecha-llegada').value = fechaLlegadaStored;
document.getElementById('fecha-salida').value = fechaSalidaStored;

if (auxStored === "1") {
    deshabilitarFechasAnteriores();
    document.getElementById('fecha-salida').disabled = false;
    actualizarFechaSalidaMin();
}

window.addEventListener('load', function () {
    localStorage.clear();
});

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

    siguienteSeccion(2);
}

var currentSection = 1;

function regresarSeccion(seccion) {
    document.getElementById('seccion' + currentSection).classList.remove('active');
    document.getElementById('seccion' + seccion).classList.add('active');
    currentSection = seccion;
    actualizarBotones();
}

function siguienteSeccion(seccion) {
    document.getElementById('seccion' + currentSection).classList.remove('active');
    document.getElementById('seccion' + seccion).classList.add('active');
    currentSection = seccion;
    actualizarBotones();
}

function actualizarBotones() {
    //document.getElementById('btnSiguiente' + currentSection).disabled = currentSection === 3;

    for (let i = 1; i <= 3; i++) {
        //document.getElementById('btnRegresar' + i).disabled = currentSection === 1;
    }
}

document.addEventListener('change', function () {
    actualizarBotones();
});


document.addEventListener('DOMContentLoaded', function () {
    actualizarBotones();
});

function validarInputTexto(input, patron, maxLength) {
    var valor = input.value;
    if (!valor.match(patron)) {
        input.value = valor.replace(/[^A-Za-zÁ-ú\s]+/g, '');
    }
    if (valor.length > maxLength) {
        input.value = valor.slice(0, maxLength);
    }
}

function validarInputNumero(input, patron, maxLength) {
    var valor = input.value;
    if (!valor.match(patron)) {
        input.value = valor.replace(/[^0-9]+/g, '');
    }
    if (valor.length > maxLength) {
        input.value = valor.slice(0, maxLength);
    }
}

function validarInputDireccion(input) {
    var valor = input.value;
    input.value = valor.replace(/[^A-Za-z0-9Á-ú\s#_-]+/g, '').slice(0, 50);
}


function validarFormulario() {
    var apPaterno = document.getElementById('apPaterno').value;
    var apMaterno = document.getElementById('apMaterno').value;
    var nombre = document.getElementById('nombre').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;
    var correo = document.getElementById('correo').value;

    var soloLetras = /^[A-Za-zÁ-ú\s]+$/;
    var letrasYEspacios = /^[A-Za-z\s]+$/;
    var direccionPatron = /^[A-Za-z0-9Á-ú\s#_-]+$/;
    var soloNumeros = /^[0-9]+$/;
    var emailPatron = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!apPaterno.match(soloLetras) || apPaterno.length > 20) {
        alert('Ingrese un apellido paterno válido (solo letras, máximo 20 caracteres).');
        return;
    }

    if (!apMaterno.match(soloLetras) || apMaterno.length > 20) {
        alert('Ingrese un apellido materno válido (solo letras, máximo 20 caracteres).');
        return;
    }

    if (!nombre.match(letrasYEspacios) || nombre.length > 30) {
        alert('Ingrese un nombre válido (solo letras y espacios, máximo 30 caracteres).');
        return;
    }

    if (!direccion.match(direccionPatron)) {
        alert('Ingrese una dirección válida.');
        return;
    }

    if (!telefono.match(soloNumeros) || telefono.length > 16) {
        alert('Ingrese un número de teléfono válido (solo números, máximo 16 caracteres).');
        return;
    }

    if (!correo.match(emailPatron)) {
        alert('Ingrese un correo electrónico válido.');
        return;
    }

    siguienteSeccion(3);
}

function validarCorreo() {
    var inputCorreo = document.getElementById('correo');
    var valorCorreo = inputCorreo.value;

    var patron = /^[A-Za-z0-9@._]+$/;

    if (!patron.test(valorCorreo)) {

        inputCorreo.value = valorCorreo.slice(0, -1);
    }
}


var elementosNoPegar = document.querySelectorAll('.noPegar');


elementosNoPegar.forEach(function (elemento) {
    elemento.addEventListener('paste', function (event) {
        event.preventDefault();
    });
});

function enviarReserva() {
    var nombre = document.getElementById('nombre').value;
    var correo = document.getElementById('correo').value;
    var fechaLlegada = document.getElementById('fecha-llegada').value;
    var fechaSalida = document.getElementById('fecha-salida').value;
    var apMaterno = document.getElementById('apMaterno').value;
    var apPaterno = document.getElementById('apPaterno').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;
    var habitacionInfo = obtenerInfoHabitaciones();

    alert('Reserva enviada:\nNombre: ' + nombre + '\nApellido paterno: ' + apPaterno
        + '\nApellido materno: ' + apMaterno + '\nDirección: ' + direccion + '\nTelefono: ' + telefono
        + '\nCorreo: ' + correo + '\nFecha de Llegada: ' + fechaLlegada +
        '\nFecha de Salida: ' + fechaSalida + '\n' + habitacionInfo);
}

function enviarDatosAlServidor() {
    var nombreActual = document.getElementById('nombre').value;
    var correoActual = document.getElementById('correo').value;
    var fechaLlegadaActual = document.getElementById('fecha-llegada').value;
    var fechaSalidaActual = document.getElementById('fecha-salida').value;
    var apMaternoActual = document.getElementById('apMaterno').value;
    var apPaternoActual = document.getElementById('apPaterno').value;
    var direccionActual = document.getElementById('direccion').value;
    var telefonoActual = document.getElementById('telefono').value;
    var habitacionInfoActual = obtenerInfoHabitaciones();


}


function obtenerInfoHabitaciones() {
    var habitacionTbody = document.getElementById('habitacion-tbody');
    var filas = habitacionTbody.getElementsByTagName('tr');

    var habitacionInfo = '';
    for (var i = 0; i < filas.length; i++) {
        var cantidad = filas[i].cells[0].textContent;
        var tipo = filas[i].cells[1].textContent;

        habitacionInfo += 'Tipo de Habitación: ' + tipo + ', Cantidad: ' + cantidad + '\n';
    }

    return habitacionInfo;
}

var habitacionSeleccionada = '';
var habitacionList = [];

//function seleccionarHabitacion(tipo) {
//    habitacionSeleccionada = tipo;
//}

function agregarHabitacion() {
    if (habitacionSeleccionada) {
        var index = habitacionList.findIndex(item => item.tipo === habitacionSeleccionada);
        console.log(index);
        if (index !== -1) {

            habitacionList[index].cantidad++;
        } else {

            habitacionList.push({ tipo: habitacionSeleccionada, cantidad: 1 });
        }

        actualizarTablaHabitaciones();
    }
}


function eliminarHabitacion(index) {
    if (habitacionList[index].cantidad > 1) {
        habitacionList[index].cantidad--;

        habitacionList[index].precio -= preciosHabitaciones[habitacionList[index].tipo];
    } else {
        habitacionList[index].precio -= preciosHabitaciones[habitacionList[index].tipo] * habitacionList[index].cantidad;
        habitacionList.splice(index, 1);
    }

    actualizarTablaHabitaciones();
    actualizarPrecioTotal();
}


function actualizarTablaHabitaciones() {
    var habitacionTbody = document.getElementById('habitacion-tbody');
    habitacionTbody.innerHTML = '';

    habitacionList.forEach(function (habitacion, index) {
        var row = habitacionTbody.insertRow();
        var cellCantidad = row.insertCell(0);
        var cellTipo = row.insertCell(1);
        var cellAcciones = row.insertCell(2);

        cellCantidad.textContent = habitacion.cantidad;
        cellTipo.textContent = habitacion.tipo;

        var btnEliminar = document.createElement('button');
        btnEliminar.textContent = 'Remover';
        btnEliminar.className = 'btn btn-eliminar';
        btnEliminar.onclick = function () {
            eliminarHabitacion(index);
        };

        cellAcciones.appendChild(btnEliminar);
    });
}

function validarReserva() {
    var tabla = document.getElementById('habitacion-table');
    var filas = tabla.getElementsByTagName('tr');

    if (filas.length <= 1) {
        alert('Por favor, agregue al menos una habitación antes de enviar la reserva.');
        return;
    }

    //enviarReserva();
    //enviarDatosAlServidor();
}

var cantidadHabitacionActual;
var tipoHabicacionActual;

function seleccionarHabitacion(tipo, element, cantidad) {
    habitacionSeleccionada = tipo;

    var cards = document.querySelectorAll('.habitacion-card');
    cards.forEach(function (card) {
        card.classList.remove('seleccionada');
    });

    element.classList.add('seleccionada');

    tipoHabicacionActual = tipo;
    cantidadHabitacionActual = cantidad;

    console.log(tipoHabicacionActual);
    console.log(cantidadHabitacionActual);
}

function guardarInformacion() {
    var informacionGenerada = obtenerInfoHabitaciones();

    document.getElementById("informacionInvisible").value = informacionGenerada;

    return true;
}

function validarYGuardarInformacion() {
    var tabla = document.getElementById('habitacion-table');
    var filas = tabla.getElementsByTagName('tr');

    if (filas.length <= 1) {
        alert('Por favor, agregue al menos una habitación antes de enviar la reserva.');
        return false;
    }

    guardarInformacion();
    return true;
}


var cantidadDisponibleParrafos = document.querySelectorAll('.cantidad-disponible');

var habitacionesDisponibles = [];

cantidadDisponibleParrafos.forEach(function (parrafo, index) {
    var cantidadDisponible = parseInt(parrafo.textContent.match(/\d+/)[0], 10);
    var tipoHabitacion = obtenerTipoHabitacion(index);
    var habitacion = { tipo: tipoHabitacion, cantidad: cantidadDisponible };
    habitacionesDisponibles.push(habitacion);
});

console.log('Habitaciones disponibles:', habitacionesDisponibles);

function obtenerTipoHabitacion(index) {
    switch (index) {
        case 0:
            return 'Individual';
        case 1:
            return 'Doble';
        case 2:
            return 'Suite';
        default:
            return '';
    }
}


function agregarHabitacionDesdeBoton() {
    if (habitacionSeleccionada) {
        verificarCantidadYAgregar();
        actualizarTablaHabitaciones();
    }
}

function verificarCantidadYAgregar() {
    var index = habitacionList.findIndex(item => item.tipo === tipoHabicacionActual);

    if (cantidadHabitacionActual > 0) {
        if (index !== -1) {
            habitacionList[index].cantidad++;
            habitacionList[index].precio += preciosHabitaciones[tipoHabicacionActual];
        } else {
            habitacionList.push({
                tipo: tipoHabicacionActual,
                cantidad: 1,
                precio: preciosHabitaciones[tipoHabicacionActual]
            });
        }

        cantidadHabitacionActual = Math.max(0, cantidadHabitacionActual - 1);
        console.log('Habitación agregada. Cantidad restante:', cantidadHabitacionActual);

        actualizarPrecioTotal();
    } else {
        alert('No hay más habitaciones disponibles de este tipo.');
    }
}


function actualizarPrecioTotal() {
    var precioTotal = 0;

    habitacionList.forEach(function (habitacion) {
        precioTotal += habitacion.precio;
    });

    var precioTotalParrafo = document.getElementById('precio-total');
    precioTotalParrafo.textContent = 'Precio total: $' + precioTotal.toLocaleString('es-MX') + ' MXN';
}


