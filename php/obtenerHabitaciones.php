<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "amanecerdoradohotel";

$conexion = mysqli_connect($servername, $username, $password, $database);

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

function obtenerCantidadHabitacionesDisponibles($conexion) {
    $query = "SELECT tipoHabitacion, COUNT(*) AS cantidad FROM habitaciones WHERE estado = 'Disponible' GROUP BY tipoHabitacion";
    
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error al obtener la cantidad de habitaciones disponibles: " . mysqli_error($conexion));
    }

    $cantidadHabitaciones = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tipo = htmlspecialchars($fila['tipoHabitacion']);
        $cantidad = htmlspecialchars($fila['cantidad']);
        $cantidadHabitaciones[$tipo] = $cantidad;
    }

    mysqli_free_result($resultado);

    return $cantidadHabitaciones;
}

$cantidadHabitacionesDisponibles = obtenerCantidadHabitacionesDisponibles($conexion);

foreach ($cantidadHabitacionesDisponibles as $tipo => $cantidad) {
    echo '<div class="habitacion-card mt-2" onclick="seleccionarHabitacion(\'' . $tipo . '\', this, \'' . $cantidad . '\', \'' . obtenerPrecio($tipo) . '\')">
            <img src="img/hab' . ucfirst($tipo) . '.jpg" alt="Habitación ' . ucfirst($tipo) . '">
            <p class="mt-4"><i class="fa-solid fa-door-open tipo-habitacion"></i> Habitación ' . ucfirst($tipo) . '</p>
            <p><i class="fa-solid fa-bed"></i> ' . obtenerDescripcionCama($tipo) . '</p>
            <p><i class="fa-solid fa-user"></i> ' . obtenerDescripcionPersonas($tipo) . '</p>
            <p class="cantidad-disponible">Cantidad disponible: ' . $cantidad . '</p>
            <p>Precio: $'. obtenerPrecio($tipo) .'</p>
        </div>';
}

function obtenerDescripcionCama($tipo) {
    switch ($tipo) {
        case 'Individual':
            return '1 cama Queen Size';
        case 'Doble':
            return '2 camas Queen Size';
        case 'Suite':
            return '1 cama King Size';
        default:
            return '';
    }
}

function obtenerPrecio($tipo) {
    switch ($tipo) {
        case 'Individual':
            return '1000';
        case 'Doble':
            return '1500';
        case 'Suite':
            return '2000';
        default:
            return '';
    }
}

function obtenerDescripcionPersonas($tipo) {
    switch ($tipo) {
        case 'Individual':
            return '1-2 personas';
        case 'Doble':
            return '2-4 personas';
        case 'Suite':
            return '1-2 personas';
        default:
            return '';
    }
}

$preciosHabitaciones = array(
    'Individual' => 1000,  
    'Doble' => 1500,       
    'Suite' => 2000        
);

echo '<script>var preciosHabitaciones = ' . json_encode($preciosHabitaciones) . ';</script>';

mysqli_close($conexion);
?>
