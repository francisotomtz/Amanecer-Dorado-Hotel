<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroHabitacion = $_POST['cliente'];
    $tipoHabitacion = $_POST['reserva'];
    $estado = $_POST['precio'];

    $numeroHabitacion = mysqli_real_escape_string($conn, $numeroHabitacion);
    $tipoHabitacion = mysqli_real_escape_string($conn, $tipoHabitacion);
    $estado = mysqli_real_escape_string($conn, $estado);

    $verificarQuery = $conn->prepare("SELECT COUNT(*) AS count FROM facturas WHERE idReserva = ?");
    $verificarQuery->bind_param("s", $tipoHabitacion);
    $verificarQuery->execute();
    $verificarResult = $verificarQuery->get_result();
    $verificarRow = $verificarResult->fetch_assoc();
    $verificarQuery->close();

    if ($verificarRow['count'] == 0) {
        $query = $conn->prepare("INSERT INTO facturas (idFactura, idCliente, idReserva, precio, metodoPago, fechaPago, pago) VALUES (NULL, ?, ?, ?, NULL, NULL, 'pendiente')");
        $query->bind_param("sss", $numeroHabitacion, $tipoHabitacion, $estado);

        if ($query->execute()) {
            echo '<script>';
            echo 'alert("FACTURA ENVIADA CORRECTAMENTE");';
            echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/reservasAct.php";';
            echo '</script>';
            exit();
        } else {
            echo "Error al agregar la factura: " . $query->error;
        }
        $query->close();
    } else {
        $errorMessage = "Ya existe una factura para la reserva con idReserva = '$tipoHabitacion'";
    }

    if (isset($errorMessage)) {
        echo '<script>';
        echo 'alert("' . $errorMessage . '");';
        echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/reservasAct.php";';
        echo '</script>';
    }
}

$conn->close();
?>
