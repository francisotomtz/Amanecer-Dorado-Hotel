<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroHabitacion = mysqli_real_escape_string($conn, $_POST['numeroHabitacion']);
    $tipoHabitacion = mysqli_real_escape_string($conn, $_POST['tipoHabitacion']);
    $precio = floatval($_POST['precio']);  // Convertir a valor numérico
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    $verificarQuery = $conn->prepare("SELECT COUNT(*) AS count FROM habitaciones WHERE noHabitacion = ?");
    $verificarQuery->bind_param("s", $numeroHabitacion);
    $verificarQuery->execute();
    $resultVerificar = $verificarQuery->get_result();
    $rowVerificar = $resultVerificar->fetch_assoc();
    $verificarQuery->close();

    if ($rowVerificar['count'] == 0) {
        $query = $conn->prepare("INSERT INTO habitaciones (noHabitacion, tipoHabitacion, precio, estado) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssds", $numeroHabitacion, $tipoHabitacion, $precio, $estado);

        if ($query->execute()) {
            header("Location: http://localhost/Amanecer-Dorado-Hotel/admin/gestionHab.php");
            exit();
        } else {
            echo "Error al agregar la habitación: " . $query->error;
        }
        $query->close();
    } else {
        echo "La habitación con número $numeroHabitacion ya existe.";
    }
}

$conn->close();
?>
