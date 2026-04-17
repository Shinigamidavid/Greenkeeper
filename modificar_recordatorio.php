<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Recordatorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div>

        <?php
        include_once("conexion.php");

        $idRecordatorio = $_GET["Id_Recordatorio"];
        $sql =  "select * from recordatorio where idRecordatorio = '$idRecordatorio'";
        $result = $conexion->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        ?>


        <form action="modificar_rec.php" method="post" class="mt-3" id="r_clientes">
            <h2 class="text-center">Modificar Recordatorios</h2>
            <input type="txt" name="Id_Recordatorio" value="<?= htmlspecialchars($row['idRecordatorio']); ?>">
            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-3 ">
                    <label for="frecuencia" class="form-label">Frecuencia de riego:</label>
                    <select class="form-control" id="frecuencia" name="frecuencia" required>
                        <option value="1" <?php if ($row["frecuencia"] == 1) echo 'selected'; ?>>1 Día</option>
                        <option value="2" <?php if ($row["frecuencia"] == 2) echo 'selected'; ?>>2 Días</option>
                        <option value="3" <?php if ($row["frecuencia"] == 3) echo 'selected'; ?>>3 Días</option>
                        <option value="4" <?php if ($row["frecuencia"] == 4) echo 'selected'; ?>>4 Días</option>
                        <option value="5" <?php if ($row["frecuencia"] == 5) echo 'selected'; ?>>5 Días</option>
                        <option value="6" <?php if ($row["frecuencia"] == 6) echo 'selected'; ?>>6 Días</option>
                        <option value="7" <?php if ($row["frecuencia"] == 7) echo 'selected'; ?>>7 Días</option>
                    </select>
                </div>

                <div class="col-sm-6 offset-sm-3 ">
                    <label for="estado">Estado:</label>
                    <select id="estado" class="form-control" name="estado" required>
                        <option value="on" <?php if ($row["estado"] == 'on') echo 'selected'; ?>>Encender</option>
                        <option value="off" <?php if ($row["estado"] == 'off') echo 'selected'; ?>>Apagar</option>
                    </select>
                </div>

                <div class="row justify-content-center align-items-center text-center">
                    <div class="col-sm-4 ">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($row['fecha']); ?>" readonly>
                    </div>
                    <div class="col-sm-4 ">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" value="<?= htmlspecialchars($row['hora']); ?>" required>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary btn-block">Modificar</button>
                </div>
        </form>
    </div>


</body>

</html>