<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro_usuario</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<?php
include_once("conexion.php");

if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["nacimiento"]) && isset($_POST["sexo"])
    && isset($_POST["identificacion"]) && isset($_POST["cel"]) && isset($_POST["correo"])
    && isset($_POST["idRol"]) && isset($_POST["password"])) {

            
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fechaNacimiento = $_POST["nacimiento"];
    $sexo = $_POST["sexo"];
    $identificacion = $_POST["identificacion"];
    $noCelular = $_POST["cel"];
    $correo = $_POST["correo"];
    $idRol = $_POST["idRol"];
    $password = $_POST["password"];
    
    // Validar que las contraseñas coincidan
    //if ($password !== $confirmar) {
    //    die("Las contraseñas no coinciden. Por favor, intente de nuevo.");
    //}

    if($conexion) {
        $sql = "INSERT INTO usuario (identificacion, nombre, apellido, fechaNacimiento,
                correo, sexo, noCelular, idRol, password)
                VALUES ('$identificacion','$nombre','$apellido','$fechaNacimiento',
                '$correo','$sexo','$noCelular','$idRol','$password')";
        $resultado = $conexion->query($sql);
        
        if($resultado) {
            echo "Registro Satisfactorio";
            header('location: GreenkeeperIndex.html');
        } else {
            echo "Error en el registro: " . $conexion->error;
        }
        
    } else {
        echo "Error en la conexión: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Datos incompletos.";
}
?>


    
</body>
</html>