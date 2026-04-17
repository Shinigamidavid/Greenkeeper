<?php

require_once 'conexion.php';

if (isset($_POST['idRecordatorio'])) {
    $idRecordatorio = $_POST['idRecordatorio'];

    // Verifica si la conexión a la base de datos está establecida
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Consulta para obtener los detalles del recordatorio
    $consulta = "SELECT u.correo, p.nombreComun AS nombrePlanta 
                 FROM recordatorio r
                 JOIN plantausuario pu ON r.idRecordatorio = pu.idRecordatorio
                 JOIN planta p ON pu.idPlanta = p.idPlanta
                 JOIN usuario u ON pu.idUsuario = u.idUsuario
                 WHERE r.idRecordatorio = ?";

    $stmt = $conexion->prepare($consulta);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("i", $idRecordatorio);
    $stmt->execute();
    $result = $stmt->get_result();
    $recordatorio = $result->fetch_assoc();

    if ($recordatorio) {
        $correo = $recordatorio['correo'];
        $nombrePlanta = $recordatorio['nombrePlanta'];

        // Configura el correo
        $subject = "Recordatorio de Planta";
        $message = "Es hora de regar tu planta: " . $nombrePlanta;
        $headers = "From: no-reply@tuapp.com";

        // Envía el correo
        if (mail($correo, $subject, $message, $headers)) {
            echo "Correo enviado a " . $correo;
        } else {
            echo "Error al enviar el correo.";
        }
    } else {
        echo "No se encontró el recordatorio.";
    }

    $stmt->close();
    $conexion->close();
}
?>
