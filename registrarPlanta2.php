<?php
include_once("conexion.php");

// Datos del formulario
$nombreComun = $conexion->real_escape_string($_POST['nombreComun']);
$idUsuario = $conexion->real_escape_string($_POST['idUsuario']);
$fechaRegistro = $conexion->real_escape_string($_POST['fechaRegistro']);
$frecuenciaRiego = $conexion->real_escape_string($_POST['frecuenciaRiego']);
$estado = $conexion->real_escape_string($_POST['estado']);

// Obtener idPlanta
$query = "SELECT idPlanta FROM planta WHERE nombreComun = '$nombreComun'";
$result = $conexion->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idPlanta = $row['idPlanta'];

    // Insertar en plantaUsuario
    $insertQuery = "INSERT INTO plantaUsuario (idUsuario, idPlanta, frecuenciaRiego, fechaRegistro, estado)
                    VALUES ('$idUsuario', '$idPlanta', '$frecuenciaRiego', '$fechaRegistro', '$estado')";

    if ($conexion->query($insertQuery) === TRUE) {
        echo "Planta registrada exitosamente.";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conexion->error;
    }
} else {
    echo "Planta no encontrada.";
}

$conexion->close();
?>
