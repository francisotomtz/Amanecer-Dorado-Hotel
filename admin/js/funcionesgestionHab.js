function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("habitacionesTable");
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function mostrarModal(numeroHabitacion, tipoHabitacion, estado) {
    $('#modalModificar').modal('show');
    $('#numeroHabitacionModal').val(numeroHabitacion);
    $('#tipoHabitacionModal').val(tipoHabitacion);
    $('#estadoHabitacionModal').val(estado);
}

document.addEventListener("DOMContentLoaded", function () {
    actualizarPrecio();
});

function actualizarPrecio() {
    var tipoHabitacion = document.getElementById('tipoHabitacion').value;
    var precioInput = document.getElementById('precio');

    switch (tipoHabitacion) {
        case 'Individual':
            precioInput.value = '1000';
            break;
        case 'Doble':
            precioInput.value = '1500';
            break;
        case 'Suite':
            precioInput.value = '2000';
            break;
        default:
            precioInput.value = '';
    }
}