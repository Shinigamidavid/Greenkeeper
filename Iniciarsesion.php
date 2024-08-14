<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesion</title>
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/estilosGreenkeeper.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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


  <nav class="navbar navbar-expand-sm bg-success navbar-dark sticky-top">
    <form class="d-flex">
      <input class="form-control me-2" type="text" placeholder="Search">
      <button class="btn btn-primary" type="button">Search</button>
    </form>
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="Registro_usuario.html">Registrarse</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Adquirir</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Contactenos</a>
        </li>
      </ul>
      <button class="btn btn-primary d-flex " onclick="history.back() ">Volver</button>
      </div>
  </nav>



  <div class="d-flex justify-content-center align-items-center" >
    <form class="col-sm-6" action="validar_login.php" method="post" id="formuinicio">
      <h1 class="text-center m-5 text-warning ">Inicio de sesión</h1>
      <hr>
      <?php
      if (isset($_GET['error'])) {
      ?>
        <p class="p-2 text-danger"><?php echo $_GET['error'] ?></p>
      <?php
      }

      ?>
      <div class="form-floating mt-5 mb-3 mx-4">
        <input type="email" name="correo" class="form-control" id="correo" placeholder="name@example.com">
        <label for="correo">Ingresa tu Correo</label>
      </div>

      <div class="col-sm-4 offset-sm-8"><a href="" class="text-warning ">Olvidaste la contraseña?</a></div>

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

</body>

</html>