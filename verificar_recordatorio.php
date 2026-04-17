<?php
include 'conexion.php';

$idPlantaUsu = $_GET['idPlantaUsu'];

$query = "SELECT COUNT(*) AS count FROM recordatorio WHERE idPlantaUsu = $idPlantaUsu";
$result = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    // La planta ya tiene un recordatorio
    echo json_encode(['tieneRecordatorio' => true]);
} else {
    // La planta no tiene un recordatorio
    echo json_encode(['tieneRecordatorio' => false]);
}

$conexion->close();
?>
