<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['name']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $mensaje = mysqli_real_escape_string($conn, $_POST['message']);

    $query = $conn->prepare("INSERT INTO opiniones (nombre, correo, mensaje) VALUES (?, ?, ?)");
    $query->bind_param("sss", $nombre, $correo, $mensaje);

    if ($query->execute()) {
        echo '<script>';
        echo 'alert("OPINION ENVIADA");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/index.html";';
        echo '</script>';
    } else {
        echo "Error al enviar el mensaje: " . $conn->error;
    }

    $query->close();
    $conn->close();
}
?>
