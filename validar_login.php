<?php
    session_start();
    include_once("conexion.php");

    if(isset($_POST["correo"]) && isset($_POST["password"])){

        function validar($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }
    $correo = validar($_POST["correo"]);
    $password = validar($_POST["password"]);

    // crear validacion para cada uno de los datos ingresados

    if(empty($correo)){
        header("location: Iniciarsesion.php?error=Correo Requerido");
        exit();
    }elseif(empty($password)){
                header("location: Iniciarsesion.php?error=Contraseña Requerida");
        exit();
    }
    else{
        $sql = "SELECT nombre, apellido, correo, password, idRol FROM usuario WHERE correo = '$correo' AND password = '$password'";
        $resultado = mysqli_query($conexion, $sql);
        if(mysqli_num_rows($resultado) === 1){
            $row = mysqli_fetch_assoc($resultado);
            if($row['correo'] === $correo && $row['password'] === $password){
                $_SESSION['correo'] = $row ['correo'];
                $_SESSION['apellido'] = $row ['apellido'];
                $_SESSION['nombre'] = $row ['nombre'];
                $_SESSION['idRol'] = $row ['idRol'];
                if($row['idRol'] == 2 ){
                    header('location: InterfazCliente.php');
                }elseif($row['idRol'] == 1 ){
                    header('location: InterfazAdmin.php');
                }
            }
            else{
                header("location: login.php?error=Correo o contraseña incorrecta");
            exit();        
            }
         }
        else{
            //password incorrecto
            header("location: Iniciarsesion.php?error=Contraseña incorrecta");
            exit();
        }
    }
} else{
    header("location: login.php?error=Correo o contraseña incorrecta");
    exit();
}

?>

