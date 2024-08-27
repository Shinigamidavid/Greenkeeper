<?php
include 'conexion.php';

if ($conexion->connect_error) {
    // Maneja el error, pero no lo imprimas directamente
    error_log("Conexión fallida: " . $conexion->connect_error);
    echo json_encode([]);
    exit;
}

if (isset($_GET['term'])) {
    $term = $conexion->real_escape_string($_GET['term']);
    $sql = "SELECT nombreComun FROM planta WHERE nombreComun LIKE '%$term%'";
    $result = $conexion->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['nombreComun'];
        }
    }

    echo json_encode($data); // Solo devuelve JSON
} else {
    echo json_encode([]); // Asegúrate de siempre devolver un JSON válido
}

$conexion->close();
?>


