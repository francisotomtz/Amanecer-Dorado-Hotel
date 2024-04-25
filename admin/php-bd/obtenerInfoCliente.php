<?php
include('conexion.php');

$idCliente = $_GET['idCliente'];

$query = "SELECT * FROM clientes WHERE idCliente = $idCliente";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();

    $html = "
      <table class='table'>
        <tr>
          <th>Id del cliente:</th>
          <td>{$cliente['idCliente']}</td>
        </tr>
        <tr>
          <th>Nombre:</th>
          <td>{$cliente['nombre']}</td>
        </tr>
        <tr>
          <th>Apellido paterno:</th>
          <td>{$cliente['apPaterno']}</td>
        </tr>
        <tr>
          <th>Apellido materno:</th>
          <td>{$cliente['apMaterno']}</td>
        </tr>
        <tr>
          <th>Dirección:</th>
          <td>{$cliente['direccion']}</td>
        </tr>
        <tr>
          <th>Teléfono:</th>
          <td>{$cliente['telefono']}</td>
        </tr>
        <tr>
          <th>Correo:</th>
          <td>{$cliente['correo']}</td>
        </tr>
      </table>
    ";

    echo $html;
} else {
    echo "No se encontró información para el cliente con ID $idCliente";
}

$conn->close();
?>

