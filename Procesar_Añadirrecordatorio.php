<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['correo'])) {
    header("location:Iniciarsesion.php?error=Debe Iniciar Sesión");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];
echo 'Correo: ' . $_SESSION['correo'];
echo 'ID Usuario: ' . $_SESSION['idUsuario'];

if (
    isset($_POST['fecha']) && isset($_POST['frecuencia']) &&
    isset($_POST['idPlantaUsu']) && isset($_POST['estado']) &&
    isset($_POST['hora'])
) {

    $fecha = $_POST['fecha'];
    $frecuencia = $_POST['frecuencia'];
    $idPlantaUsu = $_POST['idPlantaUsu'];  // Campo oculto con el ID de la planta
    $estado = $_POST['estado'];
    $hora = $_POST['hora'];

    $query = "call InsertarOActualizarRecordatorio('$estado', $frecuencia, 
    '$fecha', '$hora', $idPlantaUsu)";
    mysqli_query($conexion, $query);
} else {
    echo "Datos del formulario no están definidos correctamente.";
}

$conexion->close();
