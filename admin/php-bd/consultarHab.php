<?php
include('conexion.php');

$query = "SELECT * FROM habitaciones";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['noHabitacion'] . '</td>';
        echo '<td>' . $row['tipoHabitacion'] . '</td>';
        echo '<td>' . $row['estado'] . '</td>';
        echo '<td>$' . $row['precio'] . '</td>';
        echo '<td>';
        echo '<form method="post" action="php-bd/eliminarHab.php" style="display:inline;">';
        echo '<input type="hidden" name="numeroHabitacion" value="' . $row['noHabitacion'] . '">';
        echo '<button type="submit" class="btn btn-danger" onclick="return confirm(\'¿Estás seguro de que quieres eliminar la habitación #' . $row['noHabitacion'] . '?\')">Eliminar</button>';
        echo '</form>';
        echo '&nbsp;';
        echo '<button class="btn btn-primary" onclick="mostrarModal(' . $row['noHabitacion'] . ', \'' . $row['tipoHabitacion'] . '\', \'' . $row['estado'] . '\')">Modificar</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No hay habitaciones disponibles</td></tr>';
}

$conn->close();
?>
