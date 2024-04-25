<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = $conn->prepare("SELECT * FROM usuarios WHERE user = ? AND pass = ?");
    $sql->bind_param("ss", $username, $password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        header("Location: http://localhost/Amanecer-Dorado-Hotel/admin/panelPrincipal.html");
        exit();
    } else {
        echo '<script>';
        echo 'alert("Usuario o contraseña incorrectos");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/index.html";';
        echo '</script>';
        exit();
    }

    $sql->close();
}

$conn->close();
?>
