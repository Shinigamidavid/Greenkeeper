<?php
session_start();
include 'conexion.php';
if (isset($_SESSION['correo']) ) {
    // El usuario ha iniciado sesión correctamente
} else {
   
    header("location:Iniciarsesion.php?error=Debe Iniciar Sesión");
    exit(); 
}

$fecha_actual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Ubicaciones</title>
    <!-- Agrega enlaces a Bootstrap para el diseño responsivo -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Mis Ubicaciones</h2>

        <!-- Botón para agregar una nueva ubicación -->
        <div class="text-right mb-3">
            <a href="agregarUbicacion.php" class="btn btn-success">Agregar Ubicación</a>
        </div>

        <!-- Tabla para mostrar las ubicaciones del usuario -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre de Ubicación</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Suponiendo que ya tienes una conexión a la base de datos y has consultado las ubicaciones del usuario
                $idUsuario = $_SESSION['idUsuario']; // Obtén el ID del usuario autenticado
                $query = "SELECT idUbicacion, nombre, tipo FROM ubicacion WHERE idUbicacion = $idUsuario";
                $result = mysqli_query($conexion, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombreUbicacion'] . "</td>";
                        echo "<td>" . $row['tipo'] . "</td>";
                        echo "<td>
                                <a href='editarUbicacion.php?id=" . $row['idUbicacion'] . "' class='btn btn-primary btn-sm'>Editar</a>
                                <a href='eliminarUbicacion.php?id=" . $row['idUbicacion'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No tienes ubicaciones registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Enlace a Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>