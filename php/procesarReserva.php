<?php
include('conexion.php');

$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
$apPaterno = mysqli_real_escape_string($conn, $_POST['apPaterno']);
$apMaterno = mysqli_real_escape_string($conn, $_POST['apMaterno']);
$direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
$correo = mysqli_real_escape_string($conn, $_POST['correo']);

$sqlInsertCliente = "INSERT INTO clientes (idCliente, nombre, apPaterno, apMaterno, direccion, telefono, correo) 
                     VALUES (NULL, '$nombre', '$apPaterno', '$apMaterno', '$direccion', '$telefono', '$correo')";

if ($conn->query($sqlInsertCliente) === TRUE) {

    $idCliente = $conn->insert_id;

    $habitaciones = mysqli_real_escape_string($conn, $_POST['informacionInvisible']);
    $fechaLlegada = mysqli_real_escape_string($conn, $_POST['fecha-llegada']);
    $fechaSalida = mysqli_real_escape_string($conn, $_POST['fecha-salida']);

    $sqlInsertReserva = "INSERT INTO reservaspendientes (idReserva, idCliente, habitaciones, fechaLlegada, fechaSalida) 
                         VALUES (NULL, '$idCliente', '$habitaciones', '$fechaLlegada', '$fechaSalida')";

    if ($conn->query($sqlInsertReserva) === TRUE) {
        echo '<script>';
        echo 'alert("RESERVA COMPLETADA");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/index.html";';
        echo '</script>';
    } else {
        error_log("Error al insertar la reserva pendiente: " . $conn->error);
        echo "Error al insertar la reserva pendiente. Por favor, inténtelo de nuevo.";
    }
} else {
    error_log("Error al insertar el cliente: " . $conn->error);
    echo "Error al insertar el cliente. Por favor, inténtelo de nuevo.";
}

$conn->close();
?>
