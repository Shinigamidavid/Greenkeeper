<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    <title>Consulta de Plantas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/812f294f45.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once("conexion.php");

    // Condición de búsqueda
    $where = "";
    if (!empty($_POST)) {
        $valor = $_POST['nombreComun'];
        if (!empty($valor)) {
            $where = "WHERE nombreComun LIKE '%$valor%'";
        }
    }

    // Consulta a la base de datos
    $sql = "SELECT * FROM planta $where";
    $resultado = $conexion->query($sql);
    ?>

    <h1>Consulta de Plantas</h1>

    <!-- Formulario de búsqueda -->
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3 mt-3 p-1">
            <label for="nombreComun" class="form-label">Buscar por Nombre Común:</label>
            <input type="text" class="form-control" id="nombreComun" name="nombreComun" placeholder="Ingrese nombre de la planta">
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-4 mb-2 mt-2 p-1">
                <input type="submit" class="btn btn-info" name="buscar" value="Buscar">
            </div>
            <div class="col-sm-4 mb-2 mt-2 p-1">
                <a href="Inventario_plantas.html" class="btn btn-info">Inventario Plantas</a>
            </div>
            <div class="col-sm-4 mb-2 mt-2 p-1">
                <a href="Registro_planta.html" class="btn btn-info">Añadir</a>
            </div>
        </div>
    </form>

    <!-- Tabla de resultados -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Planta</th>
                <th>Nombre Común</th>
                <th>Nombre Científico</th>
                <th>Familia</th>
                <th>Género</th>
                <th>Especie</th>
                <th>Variedad</th>
                <th>Tipo</th>
                <th>Frecuencia de Riego (días)</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row["idPlanta"]; ?></td>
                        <td><?php echo $row["nombreComun"]; ?></td>
                        <td><?php echo $row["nombreCientifico"]; ?></td>
                        <td><?php echo $row["familia"]; ?></td>
                        <td><?php echo $row["genero"]; ?></td>
                        <td><?php echo $row["especie"]; ?></td>
                        <td><?php echo $row["variedad"]; ?></td>
                        <td><?php echo $row["tipo"]; ?></td>
                        <td><?php echo $row["frecuenciaRiego"]; ?></td>
                        <td><?php echo $row["descripcion"]; ?></td>
                        <td><img src="<?php echo $row["imagen"]; ?>" alt="Imagen planta" width="100"></td>
                        <td>
                            <!-- Enlaces para modificar y eliminar -->
                            <a href="modificar_planta.php?idPlanta=<?php echo $row["idPlanta"]; ?>" class="btn btn-warning">Modificar</a>
                            <a href="eliminar_planta.php?idPlanta=<?php echo $row["idPlanta"]; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='12'>No se encontraron registros</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $conexion->close();
    ?>
</body>

</html>