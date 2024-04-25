var idReservaActual;
var idClienteActual;
var fechaLlegadaActual;
var fechaSalidaActual;
var numerosHabitacion = [];

function mostrarModal(idReserva) {

  const idClienteSeleccionado = idReserva;

  $.ajax({
    type: 'GET',
    url: `php-bd/obtenerInfoCliente.php?idCliente=${idClienteSeleccionado}`,
    success: function (response) {
      document.getElementById('infoClienteBody').innerHTML = response;

      $('#infoClienteModal').modal('show');
    }
  });
}

function mostrarModalHabitaciones(idReserva, idCliente, fechaLlegada, fechaSalida) {
  const idReservaSeleccionado = idReserva;
  idReservaActual = idReserva;
  idClienteActual = idCliente;
  fechaLlegadaActual = fechaLlegada;
  fechaSalidaActual = fechaSalida;

  $.ajax({
    type: 'GET',
    url: `php-bd/obtenerInfoHabitaciones.php?idReserva=${idReservaSeleccionado}`,
    success: function (response) {
      document.getElementById('infoHabitacionesBody').innerHTML = response;

      $('#infoHabitacionesModal').modal('show');
    }
  });


}

$(document).on('click', '.info-cliente-btn', function () {
  const idReserva = $(this).data('idreserva');
  mostrarModal(idReserva);
});

$(document).on('click', '.info-habitaciones-btn', function () {
  const idReserva = $(this).data('idreserva');
  mostrarModalHabitaciones(idReserva);
});

const habitacionesAsignadas = new Map();

$(document).on('click', '.asignar-btn', function () {
  const noHabitacion = $(this).data('nohabitacion');
  const tipoHabitacion = $(this).data('tipohabitacion');


  if (!habitacionesAsignadas.has(noHabitacion)) {

    habitacionesAsignadas.set(noHabitacion, tipoHabitacion);


    agregarHabitacionAsignada(noHabitacion, tipoHabitacion);
  } else {

    alert('Esta habitación ya ha sido asignada.');
  }
});


$(document).on('click', '.eliminar-btn', function () {
  const noHabitacion = $(this).data('nohabitacion');

  habitacionesAsignadas.delete(noHabitacion);

  eliminarHabitacionAsignada(noHabitacion);
});

function agregarHabitacionAsignada(noHabitacion, tipoHabitacion) {
  const html = `
      <tr>
          <td>${noHabitacion}</td>
          <td>${tipoHabitacion}</td>
          <td><button class='btn btn-danger eliminar-btn' data-nohabitacion='${noHabitacion}'>Eliminar</button></td>
      </tr>
  `;

  numerosHabitacion.push(noHabitacion);

  $('#eliminarHabitacionesTable').append(html);
}

function eliminarHabitacionAsignada(noHabitacion) {
  const index = numerosHabitacion.indexOf(noHabitacion);
  if (index !== -1) {
    numerosHabitacion.splice(index, 1);
  }

  $(`#eliminarHabitacionesTable td:contains('${noHabitacion}')`).closest('tr').remove();
}

function mostrarNumerosHabitacionEnConsola() {
  console.log(idClienteActual);
  console.log(fechaLlegadaActual);
  console.log(fechaSalidaActual);
  console.log(numerosHabitacion);
}


function enviarDatosAlServidor() {
  fetch('php-bd/asignarHabitaciones.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      idReservaActual: idReservaActual,
      idClienteActual: idClienteActual,
      fechaLlegadaActual: fechaLlegadaActual,
      fechaSalidaActual: fechaSalidaActual,
      numerosHabitacion: numerosHabitacion,
    }),
  })
    .then(response => response.json())
    .then(data => {
      console.log('Respuesta del servidor:', data);
      alert('ASIGNACION COMPLETADA.');
      location.reload();
    })
    .catch(error => {
      console.error('Error al enviar datos:', error);
    });


}