<?php
include_once("conexion.php");

// Verifica si los datos y el archivo están disponibles
if (
    isset($_POST["idUbicacion"]) && isset($_POST["nombre"]) &&
    isset($_POST["fechaModificacion"]) && isset($_POST["tipo"]) &&
    isset($_FILES["imagen"])
) {
    // Obtén los datos del formulario
    $idUbicacion = $_POST['idUbicacion'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fechaModificacion'];
    $tipo = $_POST['tipo'];

    // Maneja el archivo de imagen
    $directorio = "archivos/";
    $imagen = $directorio . basename($_FILES["imagen"]["name"]);
    $tipoImagen = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));

    // Verifica si el archivo es una imagen permitida
    if ($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "webp") {
        // Intenta mover el archivo subido al directorio deseado
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen)) {
            if ($conexion) {
                // Usa una sentencia preparada para evitar inyecciones SQL
                $sql = "INSERT INTO ubicacion (idUbicacion, nombre, fecha, tipo, imagen)
                    VALUES ('$idUbicacion', '$nombre', '$fecha', '$tipo', '$imagen')";
                $resultado = $conexion->query($sql);

                if ($resultado) {
                    echo "Registro Satisfactorio";
                } else {
                    echo "Error en el registro: " . $conexion->error;
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
    echo "Datos incompletos.";
}
