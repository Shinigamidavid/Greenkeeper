<?php
require_once 'conexion.php';

function timer()
{
    session_start();
    $idUsuario = $_SESSION['idUsuario'];
    
    // Consulta para obtener los recordatorios del usuario
    $consulta = "SELECT r.idRecordatorio, r.fecha, r.frecuencia, p.nombreComun AS nombrePlanta
                 FROM recordatorio r
                 JOIN plantausuario pu ON r.idRecordatorio = p.idRecordatorio
                 JOIN planta p ON pu.idPlanta = p.idPlanta
                 WHERE pu.idUsuario = ?";
    $conexion = new mysqli(/* tu configuración de conexión */);
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $recordatorios = $result->fetch_all(MYSQLI_ASSOC);

    $data = [
        'title' => 'Mis Recordatorios',
        'recordatorios' => $recordatorios
    ];

    render('timerView.php', $data);
    $stmt->close();
    $conexion->close();
}

function render($view, $data)
{
    extract($data);
    include $view;
}
