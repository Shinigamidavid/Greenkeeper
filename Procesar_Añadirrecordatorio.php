<?php
include 'conexion.php';
session_start();

// Obtener el correo del usuario logueado
$correo = $_SESSION['correo'];

// Obtener los datos del formulario
$idPlanta = intval($_POST['idPlantaUsu']);  // Asegúrate de incluir este campo oculto en el formulario
$idRecordatorio = $_POST['frecuencia'];
$estado = $_POST['estado'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Obtener el ID del usuario a partir del correo
$consultaUsuario = $conexion->prepare("SELECT idUsuario FROM usuario WHERE correo = ?");
$consultaUsuario->bind_param('s', $correo);
$consultaUsuario->execute();
$resultadoUsuario = $consultaUsuario->get_result();
$rowUsuario = $resultadoUsuario->fetch_assoc();
$idUsuario = $rowUsuario['idUsuario'];

// Insertar los datos en la tabla plantaUsuario
$consultaInsertar = $conexion->prepare("INSERT INTO recordatorio (idRecordatorio, estado, fecha, hora) VALUES ( ?, ?, ?, ?)");
$consultaInsertar->bind_param('isss', $idRecordatorio, $estado, $fecha, $hora);

if ($consultaInsertar->execute()) {
    echo "Recordatorio registrado con éxito";
} else {
    echo "Error al registrar el Recordatorio: " . $conexion->error;
}

$consultaInsertar->close();
$conexion->close();
?>
