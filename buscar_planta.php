<?php
include 'conexion.php'; 

if($conexion->connect_error){
    die("Error de conexión: " . $conexion->connect_error);
}

if(isset($_POST['nombreComun'])){
    $nombreComun = $_POST['nombreComun'];

    $sql = "SELECT * FROM planta WHERE nombreComun LIKE '%$nombreComun%'";
    $result = $conexion->query($sql);

    $plantas = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $plantas[] = $row;
        }
    }

    echo json_encode($plantas);
}

$conexion->close();
?>
