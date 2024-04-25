<?php
include('conexion.php');

$query = "SELECT idCliente, 
                 habReservada, 
                 idReserva,
                 fechaLlegada,
                 fechaSalida,
                 precio
          FROM reservasactivas 
          WHERE estado = 'activa'
          GROUP BY idReserva";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>#' . $row['idReserva'] . '</td>';
        echo '<td><pre>' . $row['habReservada'] . '</pre></td>';
        echo '<td>' . $row['fechaLlegada'] . '</td>';
        echo '<td>' . $row['fechaSalida'] . '</td>';
        echo '<td><button type="button" class="btn btn-info" onclick="mostrarModal(' .$row['idCliente'] . ')">Mostrar Información</button></td>';
        echo '<td>';
        echo '<form method="post" action="php-bd/crearFactura.php" style="display:inline;">';
        echo '<input type="hidden" name="cliente" id="cliente" value="'.$row['idCliente'].'">';
        echo '<input type="hidden" name="reserva" id="reserva" value="'.$row['idReserva'].'">';
        echo '<input type="hidden" name="precio" id="precio" value="'.$row['precio'].'">';
        echo '<button type="submit" class="btn btn-success" onclick="return confirm(\'¿Estás seguro de que quieres eliminar la habitación #)">Enviar a pago</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No hay reservas activas</td></tr>';
}

$conn->close();
?>
