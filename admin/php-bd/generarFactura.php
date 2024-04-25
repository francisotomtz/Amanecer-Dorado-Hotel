<?php
require('fpdf186/fpdf.php');

$conexion = mysqli_connect("localhost", "root", "", "amanecerdoradohotel");

$idReservaFactura = $_POST['cliente'];

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
            f.pago,
            ra.precio AS precioReserva,
            ra.idCliente,
            ra.idReserva,
            c.direccion,
            f.metodoPago,
            f.fechaPago,
            c.telefono,
            c.correo,
            h.noHabitacion,
            h.precio AS precioHabitacion,
            h.estado
        FROM 
          reservasactivas ra
        INNER JOIN 
          clientes c ON ra.idCliente = c.idCliente
        INNER JOIN 
          habitaciones h ON ra.habReservada = h.noHabitacion
        LEFT JOIN 
          facturas f ON ra.idReserva = f.idReserva
        WHERE
          ra.idReserva = $idReservaFactura";



$resultado = mysqli_query($conexion, $query);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../img/logo.png', 15, 15, 180, 130);

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

mysqli_close($conexion);

?>
