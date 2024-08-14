<?php
    $servidor = "localhost";
    $usuario= "root";
    $contrasena = "";
    $bd = "greenkeeper1";

    //crear la conexion a la BD
    $conexion = new mysqli($servidor, $usuario, $contrasena, $bd);
    //$conexion = new mysqli("localhost", "root, "", "supermarket"); 

    //validar la conexion
    if($conexion -> connect_error){
        die("fallo en la conexion" .$conexion ->connect_error);
    }
    else{
        //echo "conexion exitosa";

    }
?>
