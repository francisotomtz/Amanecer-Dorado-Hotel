<?php
include('conexion.php');

$idReserva = $_GET['idReserva'];

$query = "SELECT * FROM reservasactivas WHERE idReserva = $idReserva";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();

    $html = "
      <table class='table'>
        <tr>
          <th>Id de reserva:</th>
          <td>{$cliente['idReserva']}</td>
        </tr>
        <tr>
          <th>Fecha de llegada:</th>
          <td>{$cliente['fechaLlegada']}</td>
        </tr>
        <tr>
          <th>Fecha de salida:</th>
          <td>{$cliente['fechaSalida']}</td>
        </tr>
        <tr>
          <th>Habitacion reservada:</th>
          <td>{$cliente['habReservada']}</td>
        </tr>
        <tr>
          <th>Id del cliente:</th>
          <td>{$cliente['idCliente']}</td>
        </tr>
        <tr>
      </table>
    ";

    echo $html;
} else {
    echo "No se encontró información para el cliente con ID $idCliente";
}

$conn->close();
?>

