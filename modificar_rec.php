<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    include_once ("conexion.php");
    
    $idRecordatorio =$_POST["Id_Recordatorio"];
    $fecha = $_POST["fecha"];
    $frecuencia = $_POST["frecuencia"];
    $estado = $_POST["estado"];
    $hora = $_POST["hora"];

    if($conexion){
        $sql = "UPDATE recordatorio set frecuencia ='$frecuencia', estado = '$estado', fecha = '$fecha', 
        hora = '$hora'
        where idRecordatorio = '$idRecordatorio' ";
        $resultado = mysqli_query($conexion,$sql);
        echo "Recordatorio Modificado Satisafactoriamente"; 
    }
    else{
        echo "Error al Modificar";
    }
    $conexion->close();
?>
<br>
<a href="consulta_recordatorios.php" class="btn btn-primary">Regresar</a>

</body>
</html>