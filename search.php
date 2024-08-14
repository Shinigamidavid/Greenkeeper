<?php
include 'conexion.php'; // Tu archivo de conexión a la base de datos

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
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

    echo json_encode($data);
} else {
    echo json_encode([]);
}

$conexion->close();
?>
