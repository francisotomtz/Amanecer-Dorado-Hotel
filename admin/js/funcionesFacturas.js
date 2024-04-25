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

function mostrarModalReserva(idReserva) {
  const idClienteSeleccionado = idReserva;

  $.ajax({
    type: 'GET',
    url: `php-bd/obtenerInfoReserva.php?idReserva=${idClienteSeleccionado}`,
    success: function (response) {
      document.getElementById('infoClienteBody').innerHTML = response;

      $('#infoClienteModal').modal('show');
    }
  });
}

function mostrarModalPago(idFactura, idCliente, idReserva, pago) {
  $('#modalModificar').modal('show');
  $('#numeroHabitacionModal').val(idFactura);
  $('#tipoHabitacionModal').val(idCliente);
  $('#estadoHabitacionModal').val(idReserva);
  $('#estadoHabitacionModalPago').val(pago);
}

document.addEventListener("DOMContentLoaded", function () {
  actualizarPrecio();
});

function actualizarPrecio() {
  var tipoHabitacion = document.getElementById('tipoHabitacion').value;
  var precioInput = document.getElementById('precio');

  switch (tipoHabitacion) {
    case 'Individual':
      precioInput.value = '$1000';
      break;
    case 'Doble':
      precioInput.value = '$1500';
      break;
    case 'Suite':
      precioInput.value = '$2000';
      break;
    default:
      precioInput.value = '';
  }
}

function obtenerFechaActual() {

  var fechaActual = new Date();

  var fechaFormateada = fechaActual.toISOString().split('T')[0];

  document.getElementById('fecha').value = fechaFormateada;
}


window.onload = obtenerFechaActual;