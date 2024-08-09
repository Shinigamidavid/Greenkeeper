<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenkeeper - Búsqueda de Plantas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Greenkeeper</a>
    <form class="form-inline ml-auto" method="POST" action="interfazcliente2.php">
        <input class="form-control mr-sm-2" type="search" name="nombreComun" placeholder="Buscar planta" aria-label="Buscar" required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="buscar">Buscar</button>
    </form>
</nav>

<div class="container mt-5">
    <?php
    if (isset($_POST['buscar'])) {
        include_once("conexion.php");

        $nombreComun = $conexion->real_escape_string($_POST['nombreComun']);
        $query = "SELECT * FROM planta WHERE nombreComun = '$nombreComun'";
        $result = $conexion->query($query);

        if ($result->num_rows > 0) {
            $planta = $result->fetch_assoc();
            ?>

            <!-- Modal -->
            <div class="modal fade show" id="plantaModal" tabindex="-1" role="dialog" aria-labelledby="plantaModalLabel" aria-hidden="true" style="display: block;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="plantaModalLabel">Detalles de la Planta</h5>
                            <a href="interfazcliente2.php" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body" id="resultadoBusqueda">
                            <!-- Resultados de la búsqueda se mostrarán aquí -->
                            <form action="registrarPlanta2.php" method="POST">
                                <input type="hidden" name="idUsuario" value="1"> <!-- Supongamos que el idUsuario está disponible de alguna manera -->
                                <input type="hidden" name="nombreComun" value="<?php echo $planta['nombreComun']; ?>">
                                <div class="form-group">
                                    <label for="nombreCientifico">Nombre Científico:</label>
                                    <input type="text" class="form-control" id="nombreCientifico" name="nombreCientifico" value="<?php echo $planta['nombreCientifico']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="familia">Familia:</label>
                                    <input type="text" class="form-control" id="familia" name="familia" value="<?php echo $planta['familia']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $planta['genero']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="especie">Especie:</label>
                                    <input type="text" class="form-control" id="especie" name="especie" value="<?php echo $planta['especie']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="variedad">Variedad:</label>
                                    <input type="text" class="form-control" id="variedad" name="variedad" value="<?php echo $planta['variedad']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo:</label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $planta['tipo']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="frecuenciaRiego">Frecuencia de Riego:</label>
                                    <select class="form-control" id="frecuenciaRiego" name="frecuenciaRiego">
                                        <option value="1" <?php echo ($planta['frecuenciaRiego'] == 1) ? 'selected' : ''; ?>>1 día</option>
                                        <option value="2" <?php echo ($planta['frecuenciaRiego'] == 2) ? 'selected' : ''; ?>>2 días</option>
                                        <option value="3" <?php echo ($planta['frecuenciaRiego'] == 3) ? 'selected' : ''; ?>>3 días</option>
                                        <option value="4" <?php echo ($planta['frecuenciaRiego'] == 4) ? 'selected' : ''; ?>>4 días</option>
                                        <option value="5" <?php echo ($planta['frecuenciaRiego'] == 5) ? 'selected' : ''; ?>>5 días</option>
                                        <option value="6" <?php echo ($planta['frecuenciaRiego'] == 6) ? 'selected' : ''; ?>>6 días</option>
                                        <option value="7" <?php echo ($planta['frecuenciaRiego'] == 7) ? 'selected' : ''; ?>>7 días</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" readonly><?php echo $planta['descripcion']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen:</label>
                                    <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo $planta['imagen']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="fechaRegistro">Fecha de Registro:</label>
                                    <input type="date" class="form-control" id="fechaRegistro" name="fechaRegistro" required>
                                </div>
                                <div class="form-group">
                                    <label>Estado del Temporizador:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="estadoActivo" value="activo" checked>
                                        <label class="form-check-label" for="estadoActivo">
                                            Activo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" id="estadoInactivo" value="inactivo">
                                        <label class="form-check-label" for="estadoInactivo">
                                            Inactivo
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="registrar">Registrar Planta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Planta no encontrada.</div>";
        }

        $conexion->close();
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
