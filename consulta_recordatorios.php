<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    <title>Consulta Recordatorios</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/812f294f45.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  </head>

<body>
  <?php
  include_once("conexion.php");

  $where = "";

  //Se Verifica si se carga o no la informacion
  if (!empty($_POST)) { //si el formulario se envia vacio
    $valor = $_POST['nombre'];
    if (!empty($valor)) {
      $where = "Where Nombre_Usuario like '%$valor%'";
    }
  }

  // Utilizar la vista lista_Recordatorios para obtener los datos
  $sql = "SELECT * FROM lista_Recordatorios $where";

  // Ejecutar la consulta
  $resultado = $conexion->query($sql);
  ?>

  <h1>Lista de Recordatorios</h1>
  <div class="row" style="float: left;"></div>
  <!-- Enviar el resultado de la busqueda sobre el mismo Scrip "Cosnultar_Cliente" con
      $_SERVER['PHP_SELF']; empieza a recorrer el script desde el inicio -->

  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="mb-3 mt-3 p-1">
      <label for="nombre" class="form-label">Nombre Usuario:</label>
      <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="row justify-content-center align-items-center">
      <div class="col-sm-4 mb-2 mt-2 p-1">
        <input type="submit" class="from-control btn btn-info" id="enviar" name="enviar" value="Buscar">
      </div>
      <div class="col-sm-4 mb-2 mt-2 p-1">
        <a href="timerView.php" class="btn btn-info">Recordatorios</a>
      </div>
      <div class="col-sm-4 mb-2 mt-2 p-1">
        <a href="Añadir_recordatorio.php" class="btn btn-info">Añadir</a>
      </div>
    </div>

  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id Usaurio</th>
        <th>Nombre Usuario</th>
        <th>Nombre Planta</th>
        <th>Fecha Creacion</th>
        <th>Id Recordatorio</th>
        <th>Frecuencia</th>
        <th>Estado</th>
        <th>Hora</th>
        <th>Proxima fecha</th>
        <th>Accion</th>

      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) { //comanod fetch_assoc(), trae todo lo que lo relaciona al resultado

      ?>
          <tr>
            <td><?php echo $row["Id_Usuario"] ?></td>
            <td><?php echo $row["Nombre_Usuario"] ?></td>
            <td><?php echo $row["Nombre_planta"] ?></td>
            <td><?php echo $row["Fecha_Creacion"] ?></td>
            <td><?php echo $row["Id_Recordatorio"] ?></td>
            <td><?php echo $row["Frecuencia"] ?></td>
            <td><?php echo $row["Estado_Recordatorio"] ?></td>
            <td><?php echo $row["Hora"] ?></td>
            <td><?php echo $row["Proxima_Fecha"] ?></td>

            <!-- El idUsuario como variable se envia con el metdodo GET, es decir por URL -->
            <td>
              <a href="modificar_recordatorio.php?Id_Recordatorio=<?php echo $row["Id_Recordatorio"]; ?>">
                <ion-icon name="create-outline" style="font-size: 36px;" class="me-2"></ion-icon>
              </a>

              <a href="#" data-href="eliminar_recordatorio.php?Id_Recordatorio=<?php echo $row["Id_Recordatorio"]; ?>"
                data-bs-toggle="modal" data-bs-target="#confirmar-delete">
                <ion-icon name="trash-outline" style="font-size: 36px; color:red"></ion-icon>
            </td>
        <?php
        }
      } else {
        echo "No existe informacion en la BD";
      }
        ?>

    </tbody>
  </table>


  <?php
  $conexion->close();
  ?>
  <?php include('modal.php') ?>

</body>
<!-- ===== ionicons ===== -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>