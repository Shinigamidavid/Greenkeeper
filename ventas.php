<?php
    session_start();
    if(!isset($_SESSION['nombre'])) {
        header("Location: ../login.php");
        exit();
    }
?>

<?php
    // session_start();
    error_reporting(0);

    $validar = $_SESSION['nombre'];

    if ($validar == null || $validar == '') {
        header("Location: ../login.php");
        die();
    }

    include_once("conexion.php");  // Asegúrate de que 'conexion.php' existe y funciona correctamente
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/estilosadmin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Administrador</title>
    <script src="https://kit.fontawesome.com/07ab0618be.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="row">
  <div class="col-6"><h2>Bienvenido - Administrador</h2></div>
  <div class="col-6"><h1 class="text-light"> <?php echo $_SESSION['nombre'];?></h1></div>
</div>

<?php


    if (!empty($_POST['IDVENTA'])) {
        $id_venta = $_POST['IDVENTA'];  // Tomamos el IDVENTA del formulario
    }

    // Llamar al procedimiento almacenado
    $sql = "CALL facturas_por_venta($id_venta)";
    $result = $conexion->query($sql);
    
?>

<h1>PEDIDOS</h1>
<div class="row" style="float:left">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3 mt-3 p-1">
            <label for="IDVENTA" class="form-label">ID VENTA</label>
            <input type="text" class="form-control" id="IDVENTA" name="IDVENTA">        
        </div>
        <div class="mb-2 mt-2 p-1">
            <input type="submit" class="form-control btn btn-info" value="Buscar"> 
        </div>
    </form>
</div>

<table class="table table-bordered">
    <thead>
      <tr>
        <th>FECHA</th>
        <th>MÉTODO DE PAGO</th>
        <th>NOMBRE DEL UNIFORME</th>
        <th>TALLA</th>
        <th>CANTIDAD</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
      <tr>
        <td><?php echo $row["fecha"]; ?></td>
        <td><?php echo $row["MetodoPago"]; ?></td>
        <td><?php echo $row["Nombre"]; ?></td>
        <td><?php echo $row["Talla"]; ?></td>
        <td><?php echo $row["Cantidad"]; ?></td>
        <td><a href="modificar_cliente.php?Id_Cliente=<?php echo $row["Id_Cliente"]; ?>">
                    <i class='fas fa-edit' style='font-size:36px; color:black'></i></a>
                    <a href="#" data-href="eliminar.php?Id_Cliente=<?php echo $row["Id_Cliente"]; ?>"
                    data-bs-toggle="modal" data-bs-target="#confirmar-delete">
                    <i class='fas fa-trash-alt' style='font-size:36px; color:red'></i></a></td>
      </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron resultados para la venta con ID: $id_venta</td></tr>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </tbody>
</table>

<?php include('modal.php'); ?>

</body>
</html>
