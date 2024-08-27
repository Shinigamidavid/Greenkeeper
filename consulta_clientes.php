<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
</head>
<body>
<?php
    include_once("conexion.php");
    $sql = "select * from usuario";
    $resultado = $conexion->query($sql);
?>

    <h1>Lista de Usuarios</h1>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Identificacion</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
      </tr>
    </thead>
    <tbody>
        <?php
            if($resultado->num_rows >0){
                while($row = $resultado->fetch_assoc()){//comanod fetch_assoc(), trae todo lo que lo relaciona al resultado
        
        ?>
      <tr>
        <td><?php echo $row["idUsuario"]?></td>
        <td><?php echo $row["nombre"]?></td>
        <td><?php echo $row["correo"]?></td>
        <td><?php echo $row["noCelular"]?></td>
      </tr>
      <?php
                   }
                }
            
      ?>

      </tbody>
  </table>
  <?php
    $conexion->close();
  ?>
</body>
</html>

