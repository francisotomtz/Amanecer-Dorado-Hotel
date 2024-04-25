<?php
include('conexion.php');

$query = "SELECT idFactura, 
                 idCliente,
                 idReserva, 
                 precio,
                 pago
          FROM facturas 
          GROUP BY idFactura";

$query .= " ORDER BY precio DESC, idFactura ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>#' . $row['idFactura'] . '</td>';
        echo '<td><button type="button" class="btn btn-info" onclick="mostrarModal(' .$row['idCliente'] . ')">Mostrar Información</button></td>';
        echo '<td><button type="button" class="btn btn-info" onclick="mostrarModalReserva(' .$row['idReserva'] . ')">Mostrar Información</button></td>';
        echo '<td>$' . $row['precio'] . '</td>';
        echo '<td>';
        echo '<form method="post" action="php-bd/generarFactura.php" style="display:inline;">';
        echo '<input type="hidden" name="cliente" id="cliente" value="'.$row['idReserva'].'">';
        echo '<button type="submit" class="btn btn-success" onclick="return confirm(\'¿Estás seguro de que quieres generar la factura #)">Generar factura</button>';
        echo '</form>';
        echo '&nbsp;';
        echo '<button class="btn btn-primary" onclick="mostrarModalPago(' . $row['idFactura'] . ', \'' . $row['idCliente'] . '\', \'' . $row['idReserva'] . '\', \'' . $row['pago'] . '\')">Realizar pago</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No hay facturas activas</td></tr>';
}

$conn->close();
?>
