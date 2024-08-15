<?php
session_start();

if (isset($_SESSION['correo'])) {
    $mensaje = "Ya estás autenticado. Puedes realizar otras acciones en esta página.";
} else {
    $fecha_actual = date('Y-m-d');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar una planta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <button class="btn btn-primary d-flex " onclick="history.back() ">Volver</button>


    <div class="btn btn-success position-fixed start-0 top-50 translate-middle-y m-3">
        <a href="GreenkeeperIndex.html" class="text-white"><i class="bi bi-house"></i></a>
    </div>

    <div class="row my-3 ">
        <div class="col-sm-6 offset-sm-3 text-center" id="formuubicacion">

            <form action="Añadir_ubicacion.php" tarjet="" method="POST" enctype="multipart/form-data">
                <h1>Green Keeper: Añadir Ubicacion</h1>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre Ubicación</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Ubicacion" required>
                    </div>
                    <div class="col-md-6 ">
                        <label for="fechaModificacion">Fecha de Modificación:</label>
                        <input type="date" id="fechaModificacion" name="fechafechaModificacion" value="<?php echo htmlspecialchars($fecha_actual); ?>">
                    </div>
                </div>
                <hr>
                <div class="row my-3 text-center">
                    <div class="col-sm-4 ">
                        <!-- <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">Dirección de la luz</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#">Norte</a></li>
                                <li><a class="dropdown-item" href="#">Sur</a></li>
                                <li><a class="dropdown-item" href="#">Oriente</a></li>
                                <li><a class="dropdown-item" href="#">Occidente</a></li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-sm-4 ">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">Tipo de Entorno</button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" data-value="interior" onclick="setDropdownValue(this)">Interior</a></li>
                                <li><a class="dropdown-item" data-value="exterior" onclick="setDropdownValue(this)">Exterior</a></li>
                            </ul>
                        </div>
                        <input type="hidden" id="tipoEntorno" name="tipoEntorno">
                        <div class="div-col-sm-4">
                            <div class="">
                                <label for="idUbicacion" class="form-label">No. Ubicación</label>
                                <input type="text" class="form-control" id="idUbicacion" name="idUbicacion" placeholder="Número de Ubicación" required>
                            </div>
                        </div>

                        <!-- <div class="mb-3">
                            <label for="tipoEntorno" class="form-label">Tipo de Entorno:</label>
                            <select id="tipoEntorno" name="tipoEntorno" class="form-select" required>
                                <option value="" disabled selected>Selecciona un tipo de entorno</option>
                                <option value="interior">Interior</option>
                                <option value="exterior">Exterior</option>
                            </select>
                        </div> -->

                    </div>
                </div>
                <hr>

                <div class="mb-3">
                    <label for="foto_ubicacion" class="form-label">Selecciona una imagen para Ubicacion:</label>
                    <input class="form-control" type="file" id="foto_ubicacion" accept="image/*">
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-6 d-flex justify-content-start">
                        <a href="Perfil.html" class="btn btn-outline-warning">Cancelar</a>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="" type="submit" class="btn btn-success">Añadir Ubicación</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
        function setDropdownValue(element) {
            // Obtén el valor del atributo data-value del elemento clickeado
            var value = element.getAttribute('data-value');
            // Asigna el valor al campo oculto
            document.getElementById('tipoEntorno').value = value;
            // Cambia el texto del botón para mostrar la opción seleccionada
            document.getElementById('btnGroupDrop1').innerText = element.innerText;
        }
    </script>

</body>

</html>