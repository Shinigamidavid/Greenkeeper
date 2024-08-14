<?php
// Conexión a la base de datos
include 'conexion.php'; // Tu archivo de conexión a la base de datos

if($conexion->connect_error){
    die("Error de conexión: " . $conexion->connect_error);
}

if(isset($_POST['nombreComun'])){
    $nombreComun = $_POST['nombreComun'];

    // Realizar la consulta SQL
    $sql = "SELECT * FROM planta WHERE nombreComun LIKE '%$nombreComun%'";
    $result = $conexion->query($sql);

    $plantas = [];
    // Verificar si hay resultados
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $plantas[] = $row;
        }
    }

    // Devolver los datos como JSON
    echo json_encode($plantas);
}

$conexion->close();
?>
