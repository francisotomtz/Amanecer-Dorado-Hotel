<?php
include('conexion.php');

$idReserva = $_GET['idReserva'];

$queryReserva = "SELECT habitaciones FROM reservaspendientes WHERE idReserva = $idReserva";
$resultReserva = $conn->query($queryReserva);

if ($resultReserva->num_rows > 0) {
    $reserva = $resultReserva->fetch_assoc();

    $htmlReserva = "
      <table class='table'>
        <tr>
          <th>Habitaciones reservadas:</th>
          <td>{$reserva['habitaciones']}</td>
        </tr>
      </table>
    ";

    $queryHabitaciones = "SELECT noHabitacion, tipoHabitacion, estado FROM habitaciones WHERE estado = 'Disponible'";
    $resultHabitaciones = $conn->query($queryHabitaciones);

    if ($resultHabitaciones->num_rows > 0) {
        $htmlHabitaciones = "
          <h2>Habitaciones disponibles</h2>
          <table class='table'>
            <tr>
              <th>Número de habitación:</th>
              <th>Tipo de habitación:</th>
              <th>Estado:</th>
              <th>Acciones</th>
            </tr>
        ";

        while ($habitacion = $resultHabitaciones->fetch_assoc()) {
            $htmlHabitaciones .= "
              <tr>
                <td>{$habitacion['noHabitacion']}</td>
                <td>{$habitacion['tipoHabitacion']}</td>
                <td>{$habitacion['estado']}</td>
                <td><button class='btn btn-primary asignar-btn' data-nohabitacion='{$habitacion['noHabitacion']}' data-tipohabitacion='{$habitacion['tipoHabitacion']}'>Seleccionar</button></td>
              </tr>
            ";
        }

        $htmlHabitaciones .= "</table>";

        $htmlEliminarHabitaciones = "
          <h2>Habitaciones seleccionadas</h2>
          <table class='table' id='eliminarHabitacionesTable'>
            <tr>
              <th>Número de habitación:</th>
              <th>Tipo de habitación:</th>
              <th>Acciones</th>
            </tr>
          </table>
        ";
    } else {
        $htmlHabitaciones = "<p>No hay habitaciones disponibles en este momento.</p>";
        $htmlEliminarHabitaciones = "";
    }

    echo $htmlReserva . $htmlHabitaciones . $htmlEliminarHabitaciones;
} else {
    echo "No se encontró información para la reserva con ID $idReserva";
}

$conn->close();
?>
