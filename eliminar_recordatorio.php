<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre del software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div> 
  
<?php
    include_once ("conexion.php");

    $id = $_GET["Id_Recordatorio"];
   
    if($conexion){
        $sql =  "delete from recordatorio where idRecordatorio= '$id'";
        $resultado = mysqli_query($conexion,$sql);
        echo"Recordatorio Eliminado";

    }
    else {
        echo "Error al Eliminar";
    }

    $conexion->close();    
    
?>
<br>
<a href="consulta_recordatorios.php" class="btn btn-primary">Regresar</a>


    
    </div>      
</body>
</html>