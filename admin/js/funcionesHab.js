
function eliminarHabitacion(numeroHabitacion) {
    if (confirm('¿Estás seguro de que quieres eliminar la habitación #' + numeroHabitacion + '?')) {
        $.ajax({
            type: 'POST',
            url: 'eliminarHab.php',
            data: { numeroHabitacion: numeroHabitacion },
            success: function (response) {
                alert(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error en la solicitud AJAX: ' + status + ', ' + error);
            }
        });
    }
}

function modificarHabitacion(numeroHabitacion, tipoHabitacion, estado) {
    $('#modalNumeroHabitacion').val(numeroHabitacion);
    $('#modalTipoHabitacion').val(tipoHabitacion);
    $('#modalEstado').val(estado);

    $('#modificarModal').modal('show');
}

function actualizarHabitacion() {

    var numeroHabitacion = $('#modalNumeroHabitacion').val();
    var tipoHabitacion = $('#modalTipoHabitacion').val();
    var estado = $('#modalEstado').val();

    $.ajax({
        type: 'POST',
        url: 'php-bd/actualizarHab.php',
        data: { numeroHabitacion: numeroHabitacion, tipoHabitacion: tipoHabitacion, estado: estado },
        success: function (response) {
            alert(response);
            $('#modificarModal').modal('hide');
        }
    });
}