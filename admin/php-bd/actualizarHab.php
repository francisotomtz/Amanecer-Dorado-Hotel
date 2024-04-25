<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroHabitacion = $_POST['numeroHabitacion'];
    $tipoHabitacion = $_POST['tipoHabitacion'];
    $estadoHabitacion = $_POST['estado'];

    $numeroHabitacion = mysqli_real_escape_string($conn, $numeroHabitacion);
    $tipoHabitacion = mysqli_real_escape_string($conn, $tipoHabitacion);
    $estadoHabitacion = mysqli_real_escape_string($conn, $estadoHabitacion);

    $query = $conn->prepare("UPDATE habitaciones SET tipoHabitacion = ?, estado = ? WHERE noHabitacion = ?");
    $query->bind_param("sss", $tipoHabitacion, $estadoHabitacion, $numeroHabitacion);

    if ($query->execute()) {
        echo '<script>';
        echo 'alert("HABITACION ACTUALIZADA CORRECTAMENTE");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/gestionHab.php";';
        echo '</script>';
        exit();
    } else {
        error_log("Error al actualizar la habitación: " . $conn->error);
        echo "Error al actualizar la habitación. Por favor, inténtelo de nuevo.";
    }

    $query->close();
}

$conn->close();
?>

