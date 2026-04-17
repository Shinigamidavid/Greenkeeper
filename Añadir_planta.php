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
  <link rel="stylesheet" href="css/estilosGreenkeeper.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI (si lo necesitas) -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap JavaScript Bundle (incluye Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .card {
      display: flex;
      flex-direction: row;
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
      background: radial-gradient(circle at center, #ffffff, #f8f9fa, #e0e0e0);
      overflow: hidden;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-body {
      max-height: none;
      overflow: visible;
      margin-left: 15px;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
    }

    .ui-autocomplete {
      z-index: 1050;
      /* Ajusta el valor según tus necesidades */
      position: absolute;
      /* Asegúrate de que sea 'absolute' para que se posicione correctamente */
    }
  </style>
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
  <a class="navbar-brand" href="Perfil.php">Greenkeeper</a>
  <form class="d-flex my-2 my-lg-0 ml-auto">
            <input class="form-control me-2" type="search" id="nombreComun" name="nombreComun"
                placeholder="Buscar planta" aria-label="Buscar">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" id="buscarBtn">Buscar</button>
        </form>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="Añadir_recordatorio.php">Agregar Recordatorio</a>
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
<!-- Modal Planta Usuario -->
<div class="modal fade" id="plantaModal" tabindex="-1" role="dialog" aria-labelledby="plantaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="plantaModalLabel">Detalles de la Planta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resultadoBusqueda">
                    <!-- Resultados de la búsqueda se mostrarán aquí -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // Autocompletado
            $('#nombreComun').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: 'buscar_planta.php',
                        method: 'GET',
                        dataType: 'json', // Asegúrate de tener este tipo de datos
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data);
                        },
                        error: function (xhr, status, error) {
                            console.error("Error en AJAX:", xhr.responseText);
                        }
                    });
                }
            });


            $('#nombreComun').on('keypress', function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                    $('#buscarBtn').click();
                }
            });

            $('#buscarBtn').click(function () {
                var nombreComun = $('#nombreComun').val();
                if (nombreComun) {
                    $.ajax({
                        url: 'getPlantaUsu.php',
                        method: 'GET',
                        data: {
                            nombreComun: nombreComun
                        },
                        success: function (data) {
                            $('#resultadoBusqueda').html(data);
                            var myModal = new bootstrap.Modal(document.getElementById('plantaModal'));
                            myModal.show();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr);
                        }
                    });
                }
            });
        });

    </script>
  <div class="row my-3">
    <div class="col-sm-6 offset-sm-3" id="formuplanta">
      <div class="row mb-3">
        <div class="col-sm-9">
          <label for="buscarPlanta" class="form-label">Buscar una Planta</label>
          <input type="text" class="form-control" id="buscarPlanta" placeholder="Nombre planta">
        </div>
        <div class="col-sm-3 d-flex align-items-center">
          <!-- Aquí se mostrará la miniatura -->
          <img id="miniatura" src="" alt="Miniatura de planta" style="max-width: 100px; display: none;">
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
              $("#frecuenciaRiego").val(planta.frecuenciaRiego);

              // Mostrar la imagen en miniatura
              if (planta.imagen) {
                $("#miniatura").attr("src", planta.imagen).show();
              } else {
                $("#miniatura").hide(); // Ocultar si no hay imagen
              }
              // Deshabilitar los campos para evitar cambios
              $("#nombreCientifico, #familia, #genero, #especie, #variedad").attr("readonly", true);
            }
          });
        });
      </script>


      <form action="Procesar_Añadirplanta.php" method="POST" enctype="multipart/form-data">
        <h1 class="text-warning">Green Keeper: Añadir planta</h1>
        <div class="row mb-3">
          <div class="col-sm-6">
            <label for="nombre" class="form-label">Nombre común</label>
            <input type="text" class="form-control" id="nombre" name="nombreComun" readonly>
          </div>
          <div class="col-sm-6">
            <input type="hidden" id="idPlanta" name="idPlanta">
            <label for="nombreCientifico" class="form-label">Nombre científico</label>
            <input type="text" class="form-control" id="nombreCientifico" name="nombreCientifico" readonly>
          </div>
        </div>
        <hr>
        <div class="row my-3 text-center">
          <div class="col-sm-6 ">
            <label for="familia" class="form-label">Familia</label>
            <input type="text" class="form-control" id="familia" placeholder="Familia">
          </div>
          <div class="col-sm-6 ">
            <label for="genero" class="form-label">Genero</label>
            <input type="text" class="form-control" id="genero" placeholder="Genero">
          </div>
        </div>

        <div class="row my-3 text-center">
          <div class="col-sm-6 ">
            <label for="especie" class="form-label">Especie</label>
            <input type="text" class="form-control" id="especie" placeholder="Especie">
          </div>

          <div class="col-sm-6 ">
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

        <hr>

        <div class="mb-3">
          <label for="foto_planta" class="form-label">Selecciona una Foto de tu planta:</label>
          <input class="form-control" type="file" id="foto_planta" name="fotoPlanta" accept="image/*">
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
  </div>


</body>

</html>