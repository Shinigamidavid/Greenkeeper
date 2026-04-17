<?php
require_once 'conexion.php';

// Verifica si la conexión a la base de datos está establecida
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Ejecuta el procedimiento almacenado
$sql = "CALL ActualizarRecordatorios()";
if ($conexion->query($sql) === TRUE) {
    echo "Recordatorios actualizados correctamente.";
} else {
    echo "Error al actualizar los recordatorios: " . $conexion->error;
}

$conexion->close();
?>
