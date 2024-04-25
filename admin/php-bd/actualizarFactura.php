<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroHabitacion = $_POST['numeroHabitacionModal'];
    $idReserva = $_POST['estadoHabitacionModal'];
    $metodo = $_POST['tarjetas'];
    $fechaActual = $_POST['fecha'];
    $tipoHabitacion = $_POST['pago'];

    $numeroHabitacion = mysqli_real_escape_string($conn, $numeroHabitacion);
    $idReserva = mysqli_real_escape_string($conn, $idReserva);
    $metodo = mysqli_real_escape_string($conn, $metodo);
    $fechaActual = mysqli_real_escape_string($conn, $fechaActual);
    $tipoHabitacion = mysqli_real_escape_string($conn, $tipoHabitacion);

    $query = $conn->prepare("UPDATE facturas SET precio='0', metodoPago = ?, fechaPago = ? , pago = ? WHERE idFactura = ?");
    $query->bind_param("ssss", $metodo, $fechaActual, $tipoHabitacion, $numeroHabitacion);

    if ($query->execute()) {
        if ($tipoHabitacion === 'Pagado') {
            $queryNueva = $conn->prepare("UPDATE reservasactivas SET estado = 'liberada' WHERE idReserva = ?");
            $queryNueva->bind_param("s", $idReserva);

            if ($queryNueva->execute()) {
                $queryObtenerHabitacion = "SELECT habReservada FROM reservasactivas WHERE idReserva = '$idReserva'";
                $resultadoHabitacion = $conn->query($queryObtenerHabitacion);

                if ($resultadoHabitacion->num_rows > 0) {
                    $filaHabitacion = $resultadoHabitacion->fetch_assoc();
                    $numeroHabitacionReservada = $filaHabitacion['habReservada'];

                    $queryActualizarHabitacion = "UPDATE habitaciones SET estado = 'Limpieza' WHERE noHabitacion = '$numeroHabitacionReservada'";
                    $conn->query($queryActualizarHabitacion);
                }

                echo '<script>';
                echo 'alert("PAGO REALIZADO CORRECTAMENTE");';
                echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/facturas.php";';
                echo '</script>';
                exit();
            } else {
                echo '<script>';
                echo 'alert("NO SE HA PAGADO LA RESERVACION");';
                echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/facturas.php";';
                echo '</script>';
                // Registra el error en un archivo de registro
                error_log("Error en la nueva consulta: " . $conn->error);
                exit();   
            }
        } else {
            echo "El pago no es 'pagado', la segunda consulta no se ejecutó.";
        }
    } else {
        echo "Error al actualizar la habitación: " . $conn->error;
    }

    $query->close();
    $queryNueva->close();

    $conn->close();
}
?>
