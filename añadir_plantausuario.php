<?php
session_start();

// Verifica si ya hay una sesión activa
if (isset($_SESSION['correo'])) {
    // Redirige al perfil si el usuario ya está conectado
    header("Location: perfil.php");
    exit();
}
include 'conexion.php'; // Tu archivo de conexión a la base de datos

// Obtener datos del formulario
$nombreComun = $_POST['nombreComun'];
$nombreCientifico = $_POST['nombreCientifico'];
$frecuenciaRiego = $_POST['frecuenciaRiego'];
$fechaCreacion = $_POST['fechaCreacion'];
// Subir la imagen
$fotoPlanta = $_FILES['fotoPlanta']['name'];
$ruta = "path/to/upload/" . basename($fotoPlanta);
move_uploaded_file($_FILES['fotoPlanta']['tmp_name'], $ruta);

// Insertar en la base de datos
$sql = "INSERT INTO plantaUsuario (nombreComun, nombreCientifico, frecuenciaRiego, fechaCreacion, fotoPlanta) 
        VALUES ('$nombreComun', '$nombreCientifico', '$frecuenciaRiego', '$fechaCreacion', '$fotoPlanta')";
if($conexion->query($sql) === TRUE){
    echo "Planta añadida con éxito.";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
