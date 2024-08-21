<?php
session_start();
include_once("conexion.php");

if (isset($_POST["correo"]) && isset($_POST["password"])) {

    function validar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $correo = validar($_POST["correo"]);
    $password = validar($_POST["password"]);

    // Validación de los datos ingresados
    if (empty($correo)) {
        header("location: Iniciarsesion.php?error=Correo Requerido");
        exit();
    } elseif (empty($password)) {
        header("location: Iniciarsesion.php?error=Contraseña Requerida");
        exit();
    } else {
        // Consulta SQL para obtener idUsuario, nombre, apellido, correo, password e idRol
        $sql = "SELECT idUsuario, nombre, apellido, correo, password, idRol FROM usuario WHERE correo = ? AND password = ?";
        $stmt = $conexion->prepare($sql);
        
        // Vincular los parámetros (s = string, ya que ambos son VARCHAR)
        $stmt->bind_param("ss", $correo, $password);
        
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            // Almacenar datos en la sesión
            $_SESSION['idUsuario'] = $row['idUsuario']; // Guardar idUsuario en la sesión
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['apellido'] = $row['apellido'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['idRol'] = $row['idRol'];

            if ($row['idRol'] == 2) {
                header('location: Perfil.php');
            } elseif ($row['idRol'] == 1) {
                header('location: InterfazAdmin.php');
            }
            exit();
        } else {
            header("location: Iniciarsesion.php?error=Correo o contraseña incorrecta");
            exit();
        }
    }
} else {
    header("location: Iniciarsesion.php?error=Correo o contraseña incorrecta");
    exit();
}
?>
