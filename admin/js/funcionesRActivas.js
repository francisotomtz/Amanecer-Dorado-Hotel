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