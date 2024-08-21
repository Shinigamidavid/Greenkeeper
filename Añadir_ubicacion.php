<?php
session_start();
if (isset($_SESSION['nombre']) && isset($_SESSION['apellido']) && isset($_SESSION['idUsuario']) ) 
include_once("conexion.php");

// Verifica si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    die("Usuario no autenticado.");
}

// Verifica si los datos y el archivo están disponibles
if (
    isset($_POST["nombre"]) && isset($_POST["fechaModificacion"]) &&
    isset($_POST["tipo"]) && isset($_FILES["imagen"])
) {
    // Obtén los datos del formulario
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fechaModificacion'];
    $tipo = $_POST['tipo'];
    $idUsuario = $_SESSION['idUsuario']; // Obtener el idUsuario de la sesión

    // Maneja el archivo de imagen
    $directorio = "archivos/";
    $imagen = $directorio . basename($_FILES["imagen"]["name"]);
    $tipoImagen = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));

    echo "ID de Usuario: " . $_SESSION['idUsuario'];

    // Verifica si el archivo es una imagen permitida
    if ($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "webp") {
        // Intenta mover el archivo subido al directorio deseado
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen)) {

            if ($conexion) {
                // Usa una sentencia preparada para evitar inyecciones SQL
                $sql = "INSERT INTO ubicacion (nombre, fecha, tipo, imagen, idUsuario) 
                VALUES ('$nombre','$fecha', 'tipo', '$imagen', $idUsuario)";
                    $resultado = $conexion->query($sql);

                if ($resultado) {
                    echo "Registro Satisfactorio";
                } else {
                    echo "Error en el registro: " . $stmt->error;
                }

                
            } else {
                echo "Error en la conexión: " . $conexion->error;
            }
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Formato de imagen no permitido. Solo se permiten archivos JPG, JPEG, PNG y WEBP.";
    }
} else {
    echo "Datos incompletos. Verifica que todos los campos estén completos y que se haya subido el archivo.";
}
?>
