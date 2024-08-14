<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenkeeper1";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombrePlanta = $_POST['nombrePlanta'];
    $frecuenciaRiego = $_POST['frecuenciaRiego'];
    $idUsuario = 1; // Asumiendo un usuario con ID 1 para el ejemplo

    // Obtener datos de la planta
    $sql = "SELECT id, frecuenciaRiego FROM planta WHERE nombreComun = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombrePlanta);
    $stmt->execute();
    $result = $stmt->get_result();
    $planta = $result->fetch_assoc();

    if ($planta) {
        $idPlanta = $planta['id'];

        // Insertar en plantaUsuario
        $sql = "INSERT INTO plantaUsuario (idPlanta, idUsuario, frecuenciaRiego) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iii", $idPlanta, $idUsuario, $frecuenciaRiego);
        $stmt->execute();
        $idPlantaUsuario = $stmt->insert_id;

        // Insertar en recordatorio
        $estado = 'encendida';
        $fechaInicio = date('Y-m-d H:i:s');
        $sql = "INSERT INTO recordatorio (idPlantaUsuario, estado, frecuencia, fechaInicio) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("isis", $idPlantaUsuario, $estado, $frecuenciaRiego, $fechaInicio);
        $stmt->execute();

        echo "Planta y recordatorio agregados con éxito.";
    } else {
        echo "Planta no encontrada.";
    }
}

$conexion->close();
?>
