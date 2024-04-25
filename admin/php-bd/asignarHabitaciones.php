<?php
$data = json_decode(file_get_contents("php://input"));

$idReservaActual = $data->idReservaActual;
$idClienteActual = $data->idClienteActual;
$fechaLlegadaActual = $data->fechaLlegadaActual;
$fechaSalidaActual = $data->fechaSalidaActual;
$numerosHabitacion = $data->numerosHabitacion;

include('conexion.php');

$responses = array();

function ejecutarQuery($conn, $sql, $successMessage, $errorMessage)
{
    if ($conn->query($sql) === TRUE) {
        return ['success' => true, 'message' => $successMessage];
    } else {
        return ['success' => false, 'message' => $errorMessage . $conn->error];
    }
}

for ($i = 0; $i < count($numerosHabitacion); $i++) {
    $sql = "INSERT INTO reservasactivas (idReserva, fechaLlegada, fechaSalida, habReservada, idCliente, precio, estado) 
            VALUES (NULL, '$fechaLlegadaActual', '$fechaSalidaActual', '{$numerosHabitacion[$i]}', '$idClienteActual', '', 'activa')";

    $responses[] = ejecutarQuery($conn, $sql, "Registro insertado correctamente para la habitación {$numerosHabitacion[$i]}", "Error al insertar el registro para la habitación {$numerosHabitacion[$i]}: ");
}

for ($i = 0; $i < count($numerosHabitacion); $i++) {
    $query = "UPDATE habitaciones SET estado = 'Reservada' WHERE noHabitacion ='{$numerosHabitacion[$i]}'";

    $responses[] = ejecutarQuery($conn, $query, "Estado actualizado a 'Reservada' para la habitación {$numerosHabitacion[$i]}", "Error al actualizar el estado para la habitación {$numerosHabitacion[$i]}: ");
}

$deleteQuery = "DELETE FROM reservaspendientes WHERE idReserva = '$idReservaActual'";
$responses[] = ejecutarQuery($conn, $deleteQuery, "Reserva pendiente eliminada correctamente", "Error al eliminar la reserva pendiente: ");

$updatePrecioQuery = "UPDATE reservasactivas ra
JOIN habitaciones h ON ra.habReservada = h.noHabitacion
SET ra.precio = h.precio";
$responses[] = ejecutarQuery($conn, $updatePrecioQuery, "Precios actualizados correctamente en reservasactivas", "Error al actualizar precios en reservasactivas: ");

$conn->close();

echo json_encode($responses);
?>
