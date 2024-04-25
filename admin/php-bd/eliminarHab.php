<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroHabitacion = $_POST['numeroHabitacion'];

    $query = "DELETE FROM habitaciones WHERE noHabitacion = '$numeroHabitacion'";

    if ($conn->query($query) === TRUE) {
        echo '<script>';
        echo 'alert("HABITACION ELIMINADA CORRECTAMENTE");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/gestionHab.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script>';
        echo 'alert("VERIFICA QUE LA HABITACION NO ESTA OCUPADA");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/gestionHab.php";';
        echo '</script>'. $conn->error;
        exit();
    }
}

$conn->close();
?>
