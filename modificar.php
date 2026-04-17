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

    $idUsuario = $_POST["idUsuario"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fechaNacimiento = $_POST["nacimiento"];
    $identificacion = $_POST["identificacion"];
    $noCelular = $_POST["cel"];
    $correo = $_POST["correo"];
    $idRol = $_POST["idRol"];
    $password = $_POST["password"];


    if($conexion){
        $sql = "UPDATE usuario set nombre ='$nombre', apellido = '$apellido', fechaNacimiento = '$fechaNacimiento', 
        identificacion = '$identificacion', noCelular = '$noCelular', correo = '$correo', idRol = '$idRol',
         password = '$password'
        where idUsuario = '$idUsuario' ";
        $resultado = mysqli_query($conexion,$sql);
        echo "Resgistro Modificado Satisafactoriamente"; 
    }
    else{
        echo "Error al Modificar";
    }
    $conexion->close();
?>
<br>
<a href="consulta_clientes.php" class="btn btn-primary">Regresar</a>

</body>
</html>