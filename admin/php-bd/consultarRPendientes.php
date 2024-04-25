<?php
include('conexion.php');

$query = "SELECT idCliente, 
                 habitaciones, 
                 idReserva,
                 fechaLlegada,
                 fechaSalida
          FROM reservaspendientes 
          GROUP BY idReserva";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>#' . $row['idReserva'] . '</td>';
        echo '<td><button type="button" class="btn btn-info" onclick="mostrarModal(' .$row['idCliente'] . ')">Mostrar Información</button></td>';
        echo '<td><button type="button" class="btn btn-info" onclick="mostrarModalHabitaciones(' .$row['idReserva'] . ',' . $row['idCliente'] . ',\'' . $row['fechaLlegada'] . '\',\'' . $row['fechaSalida'] . '\')">Asignar habitaciones</button></td>';
        echo '<td>' . $row['fechaLlegada'] . '</td>';
        echo '<td>' . $row['fechaSalida'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No hay reservas activas</td></tr>';
}

$conn->close();
?>
