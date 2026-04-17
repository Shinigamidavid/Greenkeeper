<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre del software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div>

        <?php
        include_once("conexion.php");

        $idUsuario = $_GET["idUsuario"];
        $sql =  "select * from usuario where idUsuario = '$idUsuario'";
        $result = $conexion->query($sql);
        //Se trae el resultado
        $row = $result->fetch_array(MYSQLI_ASSOC);
        ?>


        <form action="modificar.php" method="post" class="mt-3" id="r_clientes">
            <h2 class="text-center">Modificar Clientes</h2>
            
            <div class="col-sm-8 offset-sm-2">
                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre"
                    value="<?php echo $row["nombre"]; ?>">
            </div>
            <div class="col-sm-8 offset-sm-2">
                <label class="form-label" for="apellido">Apellido</label>
                <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido"
                    value="<?php echo $row["apellido"]; ?>">
            </div>
            <div class="col-sm-4">
                <label class="form-label" for="nacimiento">Fecha de nacimiento</label>
                <input class="form-control" type="date" name="nacimiento" id="nacimiento" max="2006-12-31"
                    value="<?php echo $row["fechaNacimiento"]; ?>" required>
            </div>
            <div class="col-sm-6">
                <label for="identificacion">Numero de Indetificación</label>
                <input class="form-control" type="text" name="identificacion" id="identificacion" placeholder="Numero de Identificación"
                    value="<?php echo $row["identificacion"]; ?>">
            </div>
            <div class="form-floating">
                <input class="form-control" type="email" name="correo" id="correo" placeholder="Ingresa tu email"
                    value="<?php echo $row["correo"]; ?>" required>
                <label class="form-label" for="correo">Ingresa tu email</label>
            </div>
            <div class="col-sm-6">
                <label class="form-label" for="cel">Celular</label>
                <input class="form-control" type="text" name="cel" id="cel" placeholder="Celular"
                    value="<?php echo $row["noCelular"]; ?>">
            </div>
            <div class="col-sm-6 offset-sm-3">
                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="password" name="password" id="contrasena" placeholder="contraseña"
                    value="<?php echo $row["password"]; ?>" required>
            </div>
            <div>
                <input type="text" id="idRol" name="idRol" value="<?php echo $row["idRol"]; ?>" > 
            </div>

            <!-- <div class="mb-3 mt-3">
        <label for="idUsuario" class="form-label" >Identificacion:</label>
        <input type="number" class="form-control" id="idUsuario" name="idUsuario" placeholder="Identificacion sin puntos"value="<?php echo $row[""]; ?>">
        </div> -->
            <!-- <div class="mb-3 mt-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese direccion" value="<?php echo $row["correo"]; ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="noCelular" class="form-label">Telefono:</label>
                <input type="number" class="form-control" id="noCelular" name="noCelular" placeholder="(057)0000000" value="<?php echo $row["noCelular"]; ?>">
            </div> -->



            <input type="hidden" id="ident" name="idUsuario" value="<?php echo $row["idUsuario"]; ?>">

            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-primary btn-block">Modificar</button>
            </div>
        </form>
    </div>


</body>

</html>