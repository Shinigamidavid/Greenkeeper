<?php
session_start();
if (isset($_SESSION['correo']) ) {
    // El usuario ha iniciado sesión correctamente
} else {
   
    header("location:Iniciarsesion.php?error=Debe Iniciar Sesión");
    exit(); 
}

$fecha_actual = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilosGreenkeeper.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI (si lo necesitas) -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap JavaScript Bundle (incluye Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link rel="stylesheet" href="css/estilosperfil.css">

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
        <p class="text-warning p-4"><?php echo $_SESSION['idUsuario'] . " " .$_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></p>

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
          <a class="nav-link " href="Añadir_recordatorio.php">Agregar Recordatorio</a>
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

  <div class="modal fade" id="registroExitosoModal" tabindex="-1" aria-labelledby="registroExitosoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registroExitosoModalLabel">Registro Exitoso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¡Recordatorio registrado y asignado a la planta con éxito!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Detectar el parámetro en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('registro') && urlParams.get('registroR') === 'exitoso') {
      // Mostrar el modal si el registro fue exitoso
      var registroExitosoModal = new bootstrap.Modal(document.getElementById('registroExitosoModal'));
      registroExitosoModal.show();
    }
  </script>
  
  <div class="perfil">
    <div class="container custom-width mt-5 d-flex justify-content-between position-relative">
      <div class="card">
        <div class="box box1">
          <div class="content">
            <img src="img/Conoceyregistra.webp" alt="campo-1">
            <h5>Registra y Conoce tus plantas</h5>
          </div>
        </div>
        <div class="box box2">
          <div class="content">
            <!-- <div class="icon">
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bsx-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star-half"></i>
            </div> -->
            <p>Añade nuevas plantas a tu inventario para un seguimiento detallado y personalizado.</p>
            <a href="Mis_ubicaciones.html">Ver mis ubicaciones</a>
            <a href="Mis_plantas.html">Ver mis plantas</a>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="box box1">
          <div class="content">
            <img src="img/AlbumdePlantas.webp" alt="campo-2">
            <h5>Identifica plantas</h5>
          </div>
        </div>
        <div class="box box2">
          <div class="content">
            <!-- <div class="icon">
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star-half"></i>
            </div> -->
            <p>Consulta nuestra base de datos para obtener informacion detallada
              sobre una amplia variedad de plantas, desde sus necesidades y caracteristicas.</p>
            <a href="Registro_planta.html">Identificar planta</a>
            <a href="Inventario_plantas.html">Ver plantas</a>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="box box1">
          <div class="content">
            <img src="img/Recordatorios.webp" alt="campo">
            <h5>Recordatorios de atención inteligente</h5>
          </div>
        </div>
        <div class="box box2">
          <div class="content">
            <p>Configura y recibe recordatorios para las tareas de cuidado de tus plantas,
              manteniendo un seguimiento constante para asegurar su salud y bienestar.</p>
            <a href="Mis_recordatorios.html">Ver mis tareas</a>
            <a href="Añadir_recordatorio.html">Agregar recordatorio</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <hr>


  <!-- <div class="container mt-5 ">
    <div class="row">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <img src="/img/CalendariodePlantas1.webp" class="card-img-top" alt="tu_planta">
          <div class="card-body">
            <h5 class="card-title">Calendario de Tareas</h5>
            <p class="card-text">Organiza y visualiza todas las tareas de cuidado de tus plantas en un clanedario
              interactivo, asegurando que nunca te pierdas una actividad importante.
            </p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Proxima tarea: Riego -</li>
            <li class="list-group-item">Proxima tarea: Poda -</li>
            <li class="list-group-item">Proxima tarea: Cambio de sustrato -</li>
          </ul>
          <div class="card-body">
            <a href="#" class="card-link">Ver mis Tareas</a>
            <a href="#" class="card-link">Agregar una Tarea</a>
          </div>
        </div>
      </div>
      <hr>
       <article>
        <img class="imagen" src="img/imagen1.jpg">
      </article>
    </div>
  </div>
  </div>
  -->



  <footer class="bg-dark text-success pt-4 pb-4">
    <div class="container">
      <div class="row">
        <!-- Información de Contacto -->
        <div class="col-md-4">
          <h5>Contacto</h5>
          <ul class="list-unstyled">
            <li><a href="mailto:soporte@greenkeeper.com" class="text-white">soporte@greenkeeper.com</a></li>
            <li><a href="tel:+123456789" class="text-white"><i class="bi bi-whatsapp me-2"></i>+57 310 669 3373</a></li>
            <li><a href="#" class="text-white"><i class="bi bi-geo-alt me-2"></i></i>Ubicacion</a></li>
          </ul>
        </div>

        <!-- Enlaces Rápidos -->
        <div class="col-md-4">
          <h5>Enlaces Rápidos</h5>
          <ul class="list-unstyled">
            <li><a href="GreenkeeperIndex.html" class="text-white">Inicio</a></li>
            <li><a href="#" class="text-white">Sobre Nosotros</a></li>
            <li><a href="#" class="text-white">Servicios</a></li>
            <li><a href="#" class="text-white">Blog</a></li>
            <li><a href="#" class="text-white">FAQ</a></li>
            <li><a href="#" class="text-white">Contacto</a></li>
          </ul>
        </div>

        <!-- Redes Sociales -->
        <div class="col-md-4">
          <h5>Síguenos</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white"><i class="bi bi-facebook me-2"></i>Facebook</a></li>
            <li><a href="#" class="text-white"><i class="bi bi-twitter-x me-2"></i>Twitter</a></li>
            <li><a href="#" class="text-white"><i class="bi bi-instagram me-2"></i>Instagram</a></li>
            <li><a href="#" class="text-white">LinkedIn</a></li>
          </ul>
        </div>
      </div>

      <div class="row mt-4">
        <!-- Legal -->
        <div class="col-md-12 text-center">
          <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white">Términos y Condiciones</a></li>
            <li class="list-inline-item"><a href="#" class="text-white">Política de Privacidad</a></li>
            <li class="list-inline-item"><a href="#" class="text-white">Aviso Legal</a></li>
          </ul>
        </div>

        <!-- Marca y Logotipo -->
        <div class="col-md-12 text-center mt-3">
          <img src="img/HojaBegonia.jpeg" class="rounded-circle logo" alt="Logo">

          <p class="mt-2">Greenkeeper - Mantén tus plantas siempre saludables</p>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>