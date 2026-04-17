<?php
session_start();
include 'conexion.php';
if (isset($_SESSION['correo'])) {
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
    <link rel="stylesheet" href="css/mis_plantas.css">
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    <link rel="stylesheet" href="css/estilosperfil.css">

    <title>Mis Plantas</title>
    <!-- Agrega enlaces a Bootstrap para el diseño responsivo -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Mis Plantas</h2>

        <!-- Botón para agregar una nueva planta -->
        <div class="text-right mb-3">
            <a href="Añadir_planta.php" class="btn btn-success">Agregar Planta</a>
        </div>

        <!-- Tabla para mostrar las plantas del usuario -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre Común</th>
                    <th>Nombre Científico</th>
                    <th>Tipo</th>
                    <th>Frecuencia de Riego (días)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Suponiendo que ya tienes una conexión a la base de datos y has consultado las plantas del usuario
                $idUsuario = $_SESSION['idUsuario']; // Obtén el ID del usuario autenticado
                $query = "$sql = SELECT * FROM vista_usuario_plantas $where = $idUsuario";
                $result = mysqli_query($conexion, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombreComun'] . "</td>";
                        echo "<td>" . $row['nombreCientifico'] . "</td>";
                        echo "<td>" . $row['tipo'] . "</td>";
                        echo "<td>" . $row['frecuencia'] . "</td>";
                        echo "<td>
                                <a href='verPlanta.php?id=" . $row['idPlantaUsu'] . "' class='btn btn-info btn-sm'>Ver</a>
                                <a href='editarPlanta.php?id=" . $row['idPlantaUsu'] . "' class='btn btn-primary btn-sm'>Editar</a>
                                <a href='eliminarPlanta.php?id=" . $row['idPlantaUsu'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No tienes plantas registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div id="carouselExampleControls" class="carousel slide d-none d-sm-block" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Suponiendo que ya tienes una conexión a la base de datos y has consultado las plantas del usuario
                $idUsuario = $_SESSION['idUsuario']; // Obtén el ID del usuario autenticado
                $query = "SELECT p.nombreComun, pu.fechaPlantacion, pu.estado, u.nombre AS usuarioNombre, r.estado AS EstadoRecordatorio, r.frecuencia AS FrecuenciaRecordatorio, pu.fechaCreacion, pu.imagen, pu.frecuencia
                  FROM planta p
                  JOIN plantausuario pu on p.idPlanta = pu.idPlanta
                  JOIN usuario u on pu.idUsuario = u.idUsuario
                  JOIN recordatorio r on pu.idRecordatorio = r.idRecordatorio
                  WHERE pu.idUsuario = $idUsuario";
                $result = mysqli_query($conexion, $query);

                if (mysqli_num_rows($result) > 0) {
                    $resultadoArray = $result->fetch_all(MYSQLI_ASSOC); // Almacena el resultado en una variable
$ultimoElemento = end($resultadoArray); // Obtén el último elemento

$isActive = true; // Inicializa $isActive como true para que la primera tarjeta sea activa
$carouselItemContent = ''; // Inicializa $carouselItemContent como una cadena vacía

while ($row = current($resultadoArray)) {
    // Verificar si la tarjeta actual debe ser activa
    if ($isActive) {
        $carouselItemContent .= '<div class="carousel-item active">';
        $isActive = false; // Solo la primera tarjeta debe ser activa
    } else {
        $carouselItemContent .= '<div class="carousel-item">';
    }

    $carouselItemContent .= '<div class="cards-wrapper">';
    $carouselItemContent .= '<div class="card">';
    $carouselItemContent .= '    <div class="image-wrapper">';
    $carouselItemContent .= '        <img src="' . $row['imagen'] . '" class="card-img-top" alt="Imagen de la planta">';
    $carouselItemContent .= '    </div>';
    $carouselItemContent .= '    <div class="card-body">';
    $carouselItemContent .= '        <h5 class="card-title">' . $row['nombreComun'] . '</h5>';
    $carouselItemContent .= '        <p class="card-text">Fecha de Plantación: ' . $row['fechaPlantacion'] . '</p>';
    $carouselItemContent .= '        <p class="card-text">Estado: ' . $row['estado'] . '</p>';
    $carouselItemContent .= '        <p class="card-text">Usuario: ' . $row['usuarioNombre'] . '</p>';
    $carouselItemContent .= '        <p class="card-text">Estado del Recordatorio: ' . $row['EstadoRecordatorio'] . '</p>';
    $carouselItemContent .= '        <p class="card-text">Frecuencia del Recordatorio: ' . $row['FrecuenciaRecordatorio'] . ' días</p>';
    $carouselItemContent .= '        <p class="card-text">Fecha de Creación: ' . $row['fechaCreacion'] . '</p>';
    $carouselItemContent .= '        <p class="card-text">Frecuencia de Riego: ' . $row['frecuencia'] . ' días</p>';
    $carouselItemContent .= '    </div>';
    $carouselItemContent .= '</div>';
    $carouselItemContent .= '</div>';

    // Verificar si se ha llegado al final del conjunto de tarjetas (para cerrar el ítem del carrusel)
    if ($row === $ultimoElemento) {
        $carouselItemContent .= '</div>'; // Cerrar el div de la tarjeta actual
        echo $carouselItemContent; // Mostrar el contenido acumulado
    }

    next($resultadoArray); // Mover al siguiente elemento del array
}

                    echo '<div class="carousel-item active">';
                    echo '    <div class="cards-wrapper">';
                    echo '        <div class="card">';
                    echo '            <div class="card-body text-center">';
                    echo '                <p class="card-text">No tienes plantas registradas.</p>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Enlace a Bootstrap JS y jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </div>

    <!-- Enlace a Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>