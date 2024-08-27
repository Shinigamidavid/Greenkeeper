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
  <title>Añadir una planta</title>
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
    <a href="index.html" class="text-white"><i class="bi bi-house"></i></a>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12">
      <label for="buscarPlanta" class="form-label">Buscar una Planta</label>
      <input type="text" class="form-control" id="buscarPlanta" placeholder="Nombre planta">
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#buscarPlanta").autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "buscar_planta.php", // Ruta al archivo PHP que maneja la búsqueda
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
                  data: item // Los datos adicionales para los demás campos
                };
              }));
            }
          });
          $('#nombreComun').on('keypress', function(e) {
            if (e.which === 13) { // Código de tecla para Enter
              e.preventDefault(); // Evita el comportamiento predeterminado del formulario
              $('#buscarBtn').click(); // Simula el clic en el botón de búsqueda
            }
          });
        },
        select: function(event, ui) {
          var planta = ui.item.data;
          // Llenar los otros campos con los datos seleccionados
          $("#idPlanta").val(planta.idPlanta);
          $("#nombre").val(planta.nombreComun);
          $("#nombreCientifico").val(planta.nombreCientifico);
          $("#familia").val(planta.familia);
          $("#genero").val(planta.genero);
          $("#especie").val(planta.especie);
          $("#variedad").val(planta.variedad);
          // Deshabilitar los campos para evitar cambios
          $("#nombreCientifico, #familia, #genero, #especie, #variedad").attr("readonly", true);
        }
      });
    });
  </script>


  <form action="Procesar_Añadirplanta.php" method="POST" enctype="multipart/form-data">
    <h1>Green Keeper: Registro planta</h1>
    <div class="row mb-3">
      <div class="col-sm-6">
        <label for="nombre" class="form-label">Nombre común</label>
        <input type="text" class="form-control" id="nombre" name="nombreComun" readonly>
      </div>
      <div class="col-sm-6">
        <input type="text" id="idPlanta" name="idPlanta">
        <label for="nombre_cientifico" class="form-label">Nombre científico</label>
        <input type="text" class="form-control" id="nombre_cientifico" name="nombreCientifico" readonly>
      </div>
    </div>
    <div class="row my-3 text-center">
      <div class="col-sm-4 ">
        <label for="familia" class="form-label">Familia</label>
        <input type="text" class="form-control" id="familia" placeholder="Familia">
      </div>
    </div>

    <div class="row my-3 text-center">
      <div class="col-sm-4 ">
        <label for="genero" class="form-label">Genero</label>
        <input type="text" class="form-control" id="genero" placeholder="Genero">
      </div>

      <div class="col-sm-4 ">
        <label for="especie" class="form-label">Especie</label>
        <input type="text" class="form-control" id="especie" placeholder="Especie">
      </div>

      <div class="col-sm-4 ">
        <label for="variedad" class="form-label">variedad</label>
        <input type="text" class="form-control" id="variedad" placeholder="variedad">
      </div>
    </div>
    <div class="row my-3 text-center">
      <div class="col-sm-6 ">
        <label for="plantacion">Fecha de plantacion (opcional).</label>
        <input type="date" class="form-control" id="plantacion" name="fechaPlantacion">
      </div>
      <div class="col-sm-6 ">
        <div class="div">
          <label for="estado">Estado de la planta</label>
        </div>
        <div class="form-check form-switch">
          <label class="form-check-label" for="activa">Activa</label>
          <input class="form-check-input" name="estado" type="radio" id="activa" value="activa" checked>

        </div>
        <div class="form-check form-switch">
          <label class="form-check-label" for="inactiva">Inactiva</label>
          <input class="form-check-input" name="estado" type="radio" id="inactiva" value="inctiva">

        </div>
      </div>
    </div>
    <div class="row my-3 text-center">
      <div class="col-sm-6">
        <label for="frecuenciaRiego" class="form-label">Frecuencia de Riego (días)</label>
        <select class="form-control" id="frecuenciaRiego" name="frecuenciaRiego">
          <option value="1">1 día</option>
          <option value="2">2 días</option>
          <option value="3">3 días</option>
          <option value="4">4 días</option>
          <option value="5">5 días</option>
          <option value="6">6 días</option>
          <option value="7">7 días</option>
        </select>
      </div>
      <div class="col-sm-6">
        <label for="fechaCreacion" class="form-label">Fecha de Registro</label>
        <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion" value="<?= date('Y-m-d'); ?>"
          readonly>
      </div>
    </div>

    <div class="mb-3">
      <label for="foto_planta" class="form-label">Selecciona una Foto de tu planta:</label>
      <input class="form-control" type="file" id="foto_planta" name="fotoPlanta" accept="image/*">
    </div>

    <div class="row">
      <div class="col-sm-6 d-flex justify-content-start">
        <a href="Perfil.html" class="btn btn-outline-warning">Cancelar</a>
      </div>
      <div class="col-sm-6 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Añadir Planta</button>
      </div>
    </div>
  </form>

  <!-- 
  <div class="row my-3">
    <div class="col-sm-6 offset-sm-3" id="formuplanta">
      <form action="" tarjet="" method="">
        <h1>Green Keeper: Añadir planta</h1>
        <div class="row mb-3">
          <div class="col-sm-6">
            <label for="nombre" class="form-label">Nombre comun</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre planta">
          </div>
          <div class="col-sm-6">
            <label for="nombre" class="form-label">Nombre científico</label>
            <input type="text" class="form-control" id="nombre_cientifico" placeholder="Nombre planta">
          </div>
        </div>
        <hr>
        <div class="row my-3 text-center">
          <div class="col-sm-4 ">
            <label for="division" class="form-label">Division</label>
            <input type="text" class="form-control" id="division" placeholder="Division">
          </div>
          <div class="col-sm-4 ">
            <label for="orden" class="form-label">Orden</label>
            <input type="text" class="form-control" id="orden" placeholder="Orden">
          </div>
          <div class="col-sm-4 ">
            <label for="familia" class="form-label">Familia</label>
            <input type="text" class="form-control" id="familia" placeholder="Familia">
          </div>
        </div>

        <div class="row my-3 text-center">
          <div class="col-sm-4 ">
            <label for="genero" class="form-label">Genero</label>
            <input type="text" class="form-control" id="genero" placeholder="Genero">
          </div>

          <div class="col-sm-4 ">
            <label for="especie" class="form-label">Especie</label>
            <input type="text" class="form-control" id="especie" placeholder="Especie">
          </div>

          <div class="col-sm-4 ">
            <label for="variedad" class="form-label">variedad</label>
            <input type="text" class="form-control" id="variedad" placeholder="variedad">
          </div>
        </div>
        <div class="row my-3 text-center">
          <div class="col-sm-6 ">
            <label for="plantacion">Fecha de plantacion</label>
            <input type="date" class="form-control" id="plantacion" name="plantacion">
          </div>
          <div class="col-sm-6 ">
            <div class="div">
              <label for="estado">Estado de la planta</label>
            </div>
            <div class="form-check form-switch">
              <label class="form-check-label" for="activa">Activa</label>
              <input class="form-check-input" name="estado" type="radio" id="activa" checked>

            </div>
            <div class="form-check form-switch">
              <label class="form-check-label" for="inactiva">Inactiva</label>
              <input class="form-check-input" name="estado" type="radio" id="inactiva">

            </div>
          </div>
        </div>

        <hr>

        <div class="mb-3">
          <label for="foto_planta" class="form-label">Selecciona una Foto de tu planta:</label>
          <input class="form-control" type="file" id="foto_planta" accept="image/*">
        </div>
        <hr>

        <div class="row">
          <div class="col-sm-6 d-flex justify-content-start">
            <a href="Perfil.html" class="btn btn-outline-warning">Cancelar</a>
          </div>
          <div class="col-sm-6 d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Añadir Planta</button>
          </div>
        </div>

      </form>
    </div>
  </div> -->


</body>

</html>