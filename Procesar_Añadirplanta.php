<?php
include 'conexion.php';
session_start();

// Obtener el correo del usuario logueado
$correo = $_SESSION['correo'];

// Obtener los datos del formulario
$idPlanta = intval($_POST['idPlanta']);  // Asegúrate de incluir este campo oculto en el formulario
$estado = $_POST['estado'];
$fechaPlantacion = $_POST['fechaPlantacion'];
$frecuenciaRiego = $_POST['frecuenciaRiego'];
$fechaCreacion = $_POST['fechaCreacion'];

// Obtener el ID del usuario a partir del correo
$consultaUsuario = $conexion->prepare("SELECT idUsuario FROM usuario WHERE correo = ?");
$consultaUsuario->bind_param('s', $correo);
$consultaUsuario->execute();
$resultadoUsuario = $consultaUsuario->get_result();
$rowUsuario = $resultadoUsuario->fetch_assoc();
$idUsuario = $rowUsuario['idUsuario'];

// Insertar los datos en la tabla plantaUsuario
$consultaInsertar = $conexion->prepare("INSERT INTO plantausuario (idUsuario, idPlanta, 
estado, fechaPlantacion, frecuencia, fechaCreacion) VALUES (?, ?, ?, ?, ?, ?)");
$consultaInsertar->bind_param('iissss', $idUsuario, $idPlanta, $estado, $fechaPlantacion, 
$frecuenciaRiego, $fechaCreacion);

if ($consultaInsertar->execute()) {
    echo "Planta registrada con éxito";
} else {
    echo "Error al registrar la planta: " . $conexion->error;
}

$consultaInsertar->close();
$conexion->close();
?>
