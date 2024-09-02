<?php
include 'conexion.php';
session_start();

$correo = $_SESSION['correo'];

if (
    isset($_POST['fecha']) && isset($_POST['frecuencia']) &&
    isset($_POST['idPlantaUsu']) && isset($_POST['estado']) &&
    isset($_POST['hora'])
) {

    $fechaRegistro = $_POST['fecha'];
    $frecuencia = $_POST['frecuencia'];
    $idPlantaUsu = $_POST['idPlantaUsu'];  // Campo oculto con el ID de la planta
    $estado = $_POST['estado'];
    $hora = $_POST['hora'];

    // Calcula la fechaResultado en PHP
    $fechaResultado = date('Y-m-d', strtotime($fechaRegistro . " + $frecuencia days"));

    // Obtener el ID del usuario a partir del correo
    $consultaUsuario = $conexion->prepare("SELECT idUsuario FROM usuario WHERE correo = ?");
    $consultaUsuario->bind_param('s', $correo);
    $consultaUsuario->execute();
    $resultadoUsuario = $consultaUsuario->get_result();
    $rowUsuario = $resultadoUsuario->fetch_assoc();
    $idUsuario = $rowUsuario['idUsuario'];
    $consultaUsuario->close();

    // Insertar el recordatorio en la tabla recordatorio
    $consultaInsertar = $conexion->prepare("INSERT INTO recordatorio (estado, fecha, frecuencia, hora) VALUES (?, ?, ?, ?)");
    $consultaInsertar->bind_param('ssis', $estado, $fechaResultado, $frecuencia, $hora);

    if ($consultaInsertar->execute()) {
        // Obtener el idRecordatorio generado
        $idRecordatorio = $consultaInsertar->insert_id;

        // Actualizar la tabla plantaUsuario con el idRecordatorio
        $consultaActualizar = $conexion->prepare("UPDATE plantausuario SET idRecordatorio = ? WHERE idPlantaUsu = ?");
        $consultaActualizar->bind_param('ii', $idRecordatorio, $idPlantaUsu);

        if ($consultaActualizar->execute()) {
            header('location: Perfil.php?registroR=exitoso');
            exit();
        } else {
            echo "Error al asignar el recordatorio a la planta: " . $consultaActualizar->error;
        }

        $consultaActualizar->close();
    } else {
        echo "Error al registrar el Recordatorio: " . $consultaInsertar->error;
    }

    $consultaInsertar->close();
    $conexion->close();
} else {
    echo "Datos del formulario no están definidos correctamente.";
}
