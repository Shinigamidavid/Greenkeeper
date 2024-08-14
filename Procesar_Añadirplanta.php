<?php
include 'conexion.php'; // Tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombreComun = $_POST['nombre_comun'];
    $fechaPlantacion = $_POST['fecha_plantacion'];
    $estado = $_POST['estado'];
    $idUbicacion = $_POST['id_ubicacion'];
    $frecuenciaRiego = $_POST['frecuencia_riego'];
    $idUsuario = $_SESSION['idUsuario']; // Suponiendo que tienes una sesión iniciada

    // Buscar idPlanta en la tabla planta
    $sql = "SELECT idPlanta FROM planta WHERE nombreComun = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombreComun);
    $stmt->execute();
    $result = $stmt->get_result();
    $planta = $result->fetch_assoc();

    if ($planta) {
        $idPlanta = $planta['idPlanta'];

        // Insertar en plantaUsuario
        $fechaCreacion = date('Y-m-d');
        $sqlInsert = "INSERT INTO plantaUsuario (idPlanta, idUsuario, fechaPlantacion, estado, idUbicacion, idRecordatorio, fechaCreacion) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conexion->prepare($sqlInsert);
        $idRecordatorio = null; // Aquí podrías asignar el idRecordatorio después
        $stmtInsert->bind_param("iisssis", $idPlanta, $idUsuario, $fechaPlantacion, $estado, $idUbicacion, $idRecordatorio, $fechaCreacion);
        if ($stmtInsert->execute()) {
            echo "Planta registrada con éxito";
            // Redirigir o realizar alguna acción
        } else {
            echo "Error al registrar la planta";
        }
    } else {
        echo "No se encontró la planta con ese nombre común";
    }
}
?>
