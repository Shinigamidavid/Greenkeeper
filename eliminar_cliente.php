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

    $id = $_GET["idUsuario"];
   
    if($conexion){
        $sql =  "delete from usuario where idUsuario= '$id'";
        $resultado = mysqli_query($conexion,$sql);
        echo"Registro Eliminado";

    }
    else {
        echo "Error al Eliminar";
    }

    $conexion->close();    
    
?>
<br>
<a href="consulta_clientes.php" class="btn btn-primary">Regresar</a>


    
    </div>      
</body>
</html>