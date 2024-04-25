<?php
require('fpdf186/fpdf.php');

$conexion = mysqli_connect("localhost", "root", "", "amanecerdoradohotel");

$idCliente = $_POST['cliente'];

$queryVerificacion = "SELECT COUNT(*) as countFacturas FROM facturas WHERE idCliente = $idCliente";
$resultadoVerificacion = mysqli_query($conexion, $queryVerificacion);
$verificacion = mysqli_fetch_assoc($resultadoVerificacion);

if ($verificacion['countFacturas'] > 0) {
$query = "SELECT 
            f.idFactura,
            c.idCliente,
            c.nombre,
            c.apPaterno,
            c.apMaterno,
            ra.habReservada,
            h.tipoHabitacion,
            ra.fechaLlegada,
            ra.fechaSalida,
            f.metodoPago,
            f.fechaPago,
            f.pago,
            ra.precio AS precioReserva
          FROM 
            reservasactivas ra
          INNER JOIN 
            clientes c ON ra.idCliente = c.idCliente
          INNER JOIN 
            habitaciones h ON ra.habReservada = h.noHabitacion
          LEFT JOIN 
            facturas f ON ra.idReserva = f.idReserva
          WHERE
            c.idCliente = $idCliente";

$resultado = mysqli_query($conexion, $query);

$pdf = new FPDF();
$pdf->AddPage();

while ($fila = mysqli_fetch_assoc($resultado)) {
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetX($pdf->GetX() + 140);
    $pdf->Cell(40, 10, 'Fecha: ' . $fila['fechaPago'], 0, 1);
    $pdf->Cell(40, 10, 'ID de factura: ' . $fila['idFactura'], 0, 1);
    $pdf->Cell(40, 10, 'ID de cliente: ' . $fila['idCliente'], 0, 1);
    $pdf->Cell(40, 10, 'Nombre del cliente: ' . $fila['nombre'] . ' ' . $fila['apPaterno'] . ' ' . $fila['apMaterno'], 0, 1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Cell(40, 10, 'Habitacion reservada: ' . $fila['habReservada'], 0, 1);
    $pdf->Cell(40, 10, 'Tipo de habitacion: ' . $fila['tipoHabitacion'], 0, 1);
    $pdf->Cell(40, 10, 'Fecha de llegada: ' . $fila['fechaLlegada'], 0, 1);
    $pdf->Cell(40, 10, 'Fecha de salida: ' . $fila['fechaSalida'], 0, 1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Cell(40, 10, 'Metodo de pago: ' . $fila['metodoPago'], 0, 1);
    $pdf->Cell(40, 10, 'Pago: ' . $fila['pago'], 0, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX($pdf->GetX() + 140);
    $pdf->Cell(40, 10, 'Total: $' . $fila['precioReserva'], 0, 1);
    
    $pdf->Ln();
    $pdf->Image('../img/logo.png', 15, 15, 180, 130);
}

$pdf->Output('documento.pdf', 'D');
}else{
  echo '<script>';
  echo 'alert("EL ID DEL CLIENTE NO SE ENCUENTRA EN LA TABLA FACTURAS");';
  echo 'window.location.href = "http://localhost/Amanecer-Dorado-Hotel/admin/facturas.php";';
  echo '</script>';
  exit();
}

mysqli_close($conexion);
?>