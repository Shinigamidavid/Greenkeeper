<?php
session_start();
error_reporting(0);

// Validar que el usuario esté autenticado
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] == '') {
    header("Location: ../Iniciarsesion.php");
    die();
}

include 'conexion.php'; 

// Obtener el idUsuario del usuario autenticado
$idUsuario = $_SESSION['idUsuario']; // Asegúrate de que 'idUsuario' esté en la sesión

// Consultar el nombre del rol en la base de datos
$query = "SELECT r.nombre
          FROM usuarios u
          JOIN rol r ON u.idRol = r.idRol
          WHERE u.idUsuario = $idUsuario";

// Ejecutar la consulta
$result = $conexion->query($query);

if ($result) {
    // Obtener el nombre del rol
    $row = $result->fetch_assoc();
    $_SESSION['rol'] = $row['nombre'];
} else {
    // Manejar el error en caso de fallo en la consulta
    echo "Error en la consulta: " . $conexion->error;
}

// Aquí puedes redirigir a otro archivo o simplemente dejar este código si se está ejecutando en el mismo archivo
?>
