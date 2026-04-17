<?php
include 'conexion.php';
session_start();
$correo = $_SESSION['correo'];

if (!isset($correo)) {
    header("location:Iniciarsesion.php?error=Debe Iniciar Sesión");
}

// Consulta para obtener el idUsuario
$consulta = "SELECT * FROM usuario WHERE correo = '$correo'";
$ejecuta = $conexion->query($consulta);
$row = $ejecuta->fetch_assoc();

if ($row) {
    // Almacenar el idUsuario en la sesión
    $_SESSION['idUsuario'] = $row['idUsuario'];
}
date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">

    <title>Añadir recordatorio</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5.3.3 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI 1.12.1 CSS and JS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Your custom CSS -->
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">

</head>

<body>
    <div class="container p-4 my-1 text-light" id="miContenedor">
        <div class="row align-items-center">
            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                <img src="img/HojaBegonia.jpeg" class="rounded-circle logo" alt="Logo">
            </div>
            <div class="col-sm-8">
                <h1 class="display-1 text-center">GREENKEEPER</h1>
            </div>
            <div class="col-sm-2">
                <h1>Usuario</h1>
                <p class="text-warning p-4"><?php echo $_SESSION['idUsuario'] . " " . $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></p>

            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md bg-success navbar-dark sticky-top">
        <form class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="button">Search</button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="Añadir_planta.php">Agregar Planta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Añadir-ubicacion.php">Agregar Ubicacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Contactenos</a>
                </li>
            </ul>
        </div>
        <a href="CerrarSesion.php" class="btn btn-danger">Cerrar Sesión</a>

    </nav>


    <div class="btn btn-success position-fixed start-0 top-50 translate-middle-y m-3">
        <a href="index.html" class="text-white"><i class="bi bi-house"></i></a>
    </div>

    <div class="row my-3">
        <div class="col-sm-4 offset-sm-4 text-center" id="formuplanta">

            <!-- Atributos del formulario
            action: redireccionar al servidor
            tarjet: muestra los datos misma pestaña(_blank) u otra venta (_self)
            method: especifica la forma de envio de datos del formulario
            get: variable dentro de la url
            post: transaccion -->

            <form action="Procesar_Añadirrecordatorio.php" tarjet="" method="POST" id="formuR">
                <h2 class="text-warning">Green Keeper: Añadir Recordatorio</h2>
                <p class="text-warning p-4"><?php echo $_SESSION['correo'] . " " . $_SESSION['nombre'] . " " . $_SESSION['idUsuario']; ?></p>

                <div class="row mb-3">
                    <div class="col-sm-6 offset-sm-3 ">
                        <label for="frecuencia" class="form-label">Frecuencia de riego:</label>
                        <select class="form-control" id="frecuencia" name="frecuencia" required>
                            <option value="1">1 Dia</option>
                            <option value="2">2 Dias</option>
                            <option value="3">3 Dias</option>
                            <option value="4">4 Dias</option>
                            <option value="5">5 Dias</option>
                            <option value="6">6 Dias</option>
                            <option value="7">7 Dias</option>
                        </select>
                    </div>
                    <div class="col-sm-6 offset-sm-3 ">
                        <label for="estado">Estado:</label>
                        <select id="estado" class="form-control" name="estado" required>
                            <option value="on">Encender</option>
                            <option value="off">Apagar</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center text-center">
                    <div class="col-sm-4 ">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $fecha; ?>"
                            readonly>
                    </div>
                    <div class="col-sm-4 ">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="frecuencia">Frecuencia</label>
                        <select class="form-control" id="frecuencia" name="frecuencia" required>
                            <option value="Diario">Diario</option>
                            <option value="Semanal">Semanal</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Cada 3 días">Cada 3 días</option>
                        </select>
                    </div> -->
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-sm-8 offset-sm-2 form-group">
                        <label for="buscarPlanta" class="form-label">Buscar una Planta</label>
                        <input type="text" class="form-control" id="buscarPlanta" placeholder="Nombre planta">
                        <input type="hidden" id="idPlanta" name="idPlantaUsu">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6 d-flex justify-content-start">
                        <a href="Perfil.php" class="btn btn-outline-warning">Cancelar</a>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Añadir</button>
                    </div>
                </div>
            </form>

            <script type="text/javascript">
                $(document).ready(function() {
                    $("#buscarPlanta").autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: "buscar_plantaUsu.php", // Ruta al archivo PHP que maneja la búsqueda
                                type: "POST",
                                dataType: "json",
                                data: {
                                    nombreComun: request.term
                                },
                                success: function(data) {
                                    response($.map(data, function(item) {
                                        return {
                                            label: item.nombreComun, // Lo que se mostrará en la lista
                                            value: item.nombreComun, // Lo que se llenará en el input al seleccionar
                                            idPlanta: item.idPlanta, // ID de la planta
                                            frecuencia: item.frecuencia // Si tiene frecuencia
                                        };
                                    }));
                                }
                            });
                        },
                        select: function(event, ui) {
                            $("#idPlanta").val(ui.item.idPlanta);

                            // Si la planta tiene una frecuenciaRiego asociada, mostrar el modal
                            if (ui.item.frecuencia) {
                                $('#confirmarModal').modal('show');

                                // Evitar la duplicación de eventos click sobre el botón de confirmar
                                $('#confirmarActualizar').off('click').on('click', function() {
                                    $('#formuR').submit(); // Envía el formulario para actualizar
                                });
                            } else {
                                // Si no hay frecuencia, continuar con el proceso normal
                                $('#formuR').submit();
                            }
                        }
                    });
                });
            </script>

            <!-- Modal de confirmación -->
            <div class="modal fade" id="confirmarModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmarModalLabel">Confirmación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            La planta usuario ya tiene un recordatorio. ¿Desea reemplazarlo?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="confirmarActualizar">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container text-center mt-5">
    <h1>Temporizador</h1>
    <div id="timer">00:00:00</div>
    <button class="btn btn-primary mt-3" onclick="startTimer()">Iniciar</button>
    <button class="btn btn-secondary mt-3" onclick="stopTimer()">Detener</button>
    <button class="btn btn-danger mt-3" onclick="resetTimer()">Reiniciar</button>
</div> -->

</body>

</html>