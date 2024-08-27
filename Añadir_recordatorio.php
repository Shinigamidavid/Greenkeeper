<?php
include 'conexion.php';
session_start();
$correo = $_SESSION['correo'];
if (!isset($correo)) {
  header("location:Iniciarsesion.php?error=Debe Iniciar Sesión");
}
$consulta = "SELECT * FROM usuario WHERE correo = '$correo'";
$ejecuta = $conexion->query($consulta);
$row = $ejecuta->fetch_assoc();

//$fecha_actual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir recordatorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
</head>

<body>
    <button class="btn btn-primary d-flex " onclick="history.back() ">Volver</button>


    <div class="btn btn-success position-fixed start-0 top-50 translate-middle-y m-3">
        <a href="GreenkeeperIndex.html" class="text-white"><i class="bi bi-house"></i></a>
    </div>

    <div class="row my-3">
        <div class="col-sm-4 offset-sm-4 text-center" id="formuplanta">

            <!-- Atributos del formulario
            action: redireccionar al servidor
            tarjet: muestra los datos misma pestaña(_blank) u otra venta (_self)
            method: especifica la forma de envio de datos del formulario
            get: variable dentro de la url
            post: transaccion -->

            <form action="Procesar_Añadirrecordatorio.php" tarjet="" method="POST">
                <h2 class="text-warning">Green Keeper: Añadir Recordatorio</h2>
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
                            <option value="encender">Encender</option>
                            <option value="apagar">Apagar</option>
                        </select>
                    </div>
                </div>

                <div class="row ms-3 text-center">
                    <div class="col-sm-4 ">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
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
                        <input type="text" id="idPlanta" name="idPlanta">
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
                $(document).ready(function () {
                    $("#buscarPlanta").autocomplete({
                        source: function (request, response) {
                            $.ajax({
                                url: "buscar_planta.php", // Ruta al archivo PHP que maneja la búsqueda
                                type: "POST",
                                dataType: "json",
                                data: {
                                    nombreComun: request.term
                                },
                                success: function (data) {
                                    response($.map(data, function (item) {
                                        return {
                                            label: item.nombreComun, // Lo que se mostrará en la lista
                                            value: item.nombreComun, // Lo que se llenará en el input al seleccionar
                                            idPlanta: item.idPlanta // Agregar el ID de la planta
                                        };
                                    }));
                                }
                            });
                            $('#nombreComun').on('keypress', function (e) {
                                if (e.which === 13) { // Código de tecla para Enter
                                    e.preventDefault(); // Evita el comportamiento predeterminado del formulario
                                    $('#buscarBtn').click(); // Simula el clic en el botón de búsqueda
                                }
                            });
                        },
                        select: function (event, ui) {
                            $("#idPlanta").val(ui.item.idPlanta);
                        }
                    });
                });
            </script>
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