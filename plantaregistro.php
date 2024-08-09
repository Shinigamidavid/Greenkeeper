<?php
include_once("conexion.php");

if (
    isset($_POST["nombreComun"]) && isset($_POST["nombreCientifico"]) && isset($_POST["familia"]) &&
    isset($_POST["genero"]) && isset($_POST["especie"]) && isset($_POST["variedad"]) && isset($_POST["tipo"]) 
    && isset($_POST["frecuencia"]) && isset($_POST["descripcion"]) && isset($_FILES["imagen"])
) {
    $nombreComun = $_POST["nombreComun"];
    $nombreCientifico = $_POST["nombreCientifico"];
    $familia = $_POST["familia"];
    $genero = $_POST["genero"];
    $especie = $_POST["especie"];
    $variedad = $_POST["variedad"];
    $tipo = $_POST["tipo"];
    $frecuencia = $_POST['frecuencia'];
    $descripcion = $_POST["descripcion"];

    $directorio = "archivos/";
    $imagen = $directorio . basename($_FILES["imagen"]["name"]);
    $tipoImagen = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen permitida
    if ($tipoImagen == "jpg" || $tipoImagen == "jpeg" || $tipoImagen == "png" || $tipoImagen == "webp") {
        // Intentar mover el archivo subido al directorio deseado
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen)) {
            // Conexión a la base de datos
            if ($conexion) {
                $sql = "INSERT INTO planta (nombreComun, nombreCientifico, familia, genero, especie,
                 variedad, tipo, frecuenciaRiego, descripcion, imagen) VALUES ('$nombreComun',
                 '$nombreCientifico','$familia','$genero','$especie','$variedad','$tipo',
                 '$frecuencia','$descripcion','$imagen')";

                $resultado = $conexion->query($sql);

                if ($resultado) {
                    header('Location: inventario_plantas.html'); // Redirigir a la página de tarjetas
                    exit;
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
?>
