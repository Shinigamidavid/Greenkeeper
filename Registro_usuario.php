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
    // $idRol = $_POST["idRol"];
    $password = $_POST["password"];
    
    // Validar que las contraseñas coincidan
    //if ($password !== $confirmar) {
    //    die("Las contraseñas no coinciden. Por favor, intente de nuevo.");
    //}

    if($conexion) {
        $sql = "INSERT INTO usuario (identificacion, nombre, apellido, fechaNacimiento,
                correo, sexo, noCelular, idRol, password)
                VALUES ('$identificacion','$nombre','$apellido','$fechaNacimiento',
                '$correo','$sexo','$noCelular',2,'$password')";
        $resultado = $conexion->query($sql);
        
        if ($resultado) {
            header('location: index.html?registro=exitoso');
            exit(); // Asegura que se detiene la ejecución después de la redirección
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