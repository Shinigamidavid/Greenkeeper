<?php
session_start();

// Verifica si ya hay una sesión activa
if (isset($_SESSION['correo'])) {
  // Redirige al perfil si el usuario ya está conectado
  header("Location: perfil.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilosGreenkeeper.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <title>Iniciar sesion</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI (si lo necesitas) -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Bootstrap JavaScript Bundle (incluye Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

  <div class="container p-4 my-1 text-light" id="miContenedor">
    <div class="row align-items-center">
      <div class="col-sm-2 d-flex justify-content-center align-items-center">
        <img src="img/HojaBegonia.jpeg" class="rounded-circle logo" alt="Logo">
      </div>
      <div class="col-sm-10">
        <h1 class="display-1 text-center">GREENKEEPER</h1>
      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-md navbar-dark bg-success sticky-top">
    <a class="navbar-brand" href="GreenkeeperIndex.html">Greenkeeper</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item active">
          <a class="nav-link" href="Registro_usuario.html">Registrarse</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tienda">Adquirir</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="funcion">Recordatorios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Contactenos</a>
        </li>
      </ul>
    </div>
    <button class="btn btn-primary d-flex " onclick="history.back() ">Volver</button>
  </nav>



  <div class="d-flex justify-content-center align-items-center ">
    <form class="col-sm-6 my-5" action="validate.php" method="post" id="formuinicio">
      <h1 class="text-center m-2 text-warning ">Inicio de sesión</h1>
      <hr>
      <?php
      if (isset($_GET['error'])) {
      ?>
        <p class="p-2 text-danger"><?php echo $_GET['error'] ?></p>
      <?php
      }

      ?>
      <div class="form-floating mt-3 mb-3 mx-4">
        <input type="email" name="correo" class="form-control" id="correo" placeholder="name@example.com">
        <label for="correo">Ingresa tu Correo</label>
      </div>

      <div class="col-sm-4 offset-sm-4 mb-2"><a href="" class="text-warning ">Olvidaste la contraseña?</a></div>

      <div class="form-floating input-wrapper mx-5 mb-3">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Contraseña</label>
        <i class="bi bi-eye" id="togglePassword"></i>
      </div>

      <div class="row mx-5">
        <div class="col-sm-6 d-flex justify-content-start">
          <div class="d-grid gap-3">
            <a href="Registro_usuario.html">Crear Cuenta</a>
          </div>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
          <!-- <a href="#" type="submit" class="btn btn-success">Iniciar Sesion</a> -->

          <div class="d-grid gap-3">
            <button type="submit" class="btn btn-success btn-block">Inciar Sesión</button>
          </div>
        </div>
      </div>
      <hr>
      <div class="col-sm-4 offset-sm-4 text-center ">
        <a href="GreenkeeperIndex.html">Volver al incio </a>
      </div>
    </form>

  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordField = document.getElementById('password');
      const icon = this;

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        passwordField.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    });
  </script>

  <footer class="bg-dark text-success pt-4 pb-4 text-center">
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