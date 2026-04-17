<?php
include 'conexion.php'; 
session_start();  // Asegúrate de iniciar la sesión

// Verifica si la sesión está activa y obtiene el idUsuario
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];

    // Consulta para obtener los recordatorios del usuario
    $sql = "
        SELECT r.idRecordatorio, r.fecha, r.frecuencia, r.estado, p.nombreComun
        FROM recordatorio r
        JOIN plantausuario pu ON r.frecuencia = pu.frecuencia
        JOIN planta p ON pu.idPlanta = p.idPlanta
        WHERE pu.idUsuario = '$idUsuario'
    ";

    $result = $conexion->query($sql);

    $recordatorios = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recordatorios[] = $row;
        }
    }

    // Mostrar los recordatorios en una tabla debajo del formulario si existen
    if (!empty($recordatorios)) {
        echo '<h3>Tus Recordatorios:</h3>';
        echo '<table class="table">';
        echo '<thead><tr><th>Planta</th><th>Fecha</th><th>Frecuencia</th><th>Estado</th></tr></thead>';
        echo '<tbody>';
        foreach ($recordatorios as $recordatorio) {
            echo '<tr>';
            echo '<td>' . $recordatorio['nombreComun'] . '</td>';
            echo '<td>' . $recordatorio['fecha'] . '</td>';
            echo '<td>' . $recordatorio['frecuencia'] . ' días</td>';
            echo '<td>' . ucfirst($recordatorio['estado']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}
?>
