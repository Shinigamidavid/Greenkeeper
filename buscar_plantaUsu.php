<?php
include 'conexion.php'; 
session_start();  // Asegúrate de iniciar la sesión

// Verifica si la sesión está activa y obtiene el idUsuario
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    if (isset($_POST['nombreComun'])) {
        $nombreComun = $conexion->real_escape_string($_POST['nombreComun']);  // Escapando datos para evitar SQL injection

        // Consulta con JOIN para obtener las plantas del usuario en la sesión
        $sql = "
            SELECT pu.*, p.nombreComun
            FROM plantausuario pu
            JOIN planta p ON pu.idPlanta = p.idPlanta
            WHERE p.nombreComun LIKE '%$nombreComun%' AND pu.idUsuario = '$idUsuario'
        ";

        $result = $conexion->query($sql);

        $plantas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $plantas[] = $row;
            }
        }

        echo json_encode($plantas);
    }

    $conexion->close();
} else {
    echo json_encode(['error' => 'No ha iniciado sesión correctamente']);
}
?>
