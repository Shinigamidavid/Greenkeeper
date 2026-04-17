<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Planta - Green Keeper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <?php
        include_once("conexion.php");
        
        // Obtener la ID de la planta desde la URL
        $idPlanta = $_GET['idPlanta'];
        
        // Consultar la información de la planta desde la base de datos
        $sql = "SELECT * FROM planta WHERE idPlanta = '$idPlanta'";
        $result = $conexion->query($sql);
        $planta = $result->fetch_array(MYSQLI_ASSOC);
        ?>
        
        <form action="modificar_planta.php" method="post" enctype="multipart/form-data">
            <h1>Modificar Planta</h1>
            
            <!-- Campo oculto para enviar el ID de la planta -->
            <input type="hidden" name="idPlanta" value="<?php echo $planta['idPlanta']; ?>">
            
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="nombreComun" class="form-label">Nombre Común</label>
                    <input type="text" class="form-control" name="nombreComun" id="nombreComun" value="<?php echo $planta['nombreComun']; ?>" required>
                </div>
                <div class="col-sm-6">
                    <label for="nombreCientifico" class="form-label">Nombre Científico</label>
                    <input type="text" class="form-control" name="nombreCientifico" id="nombreCientifico" value="<?php echo $planta['nombreCientifico']; ?>">
                </div>
            </div>
            
            <hr>
            
            <div class="row my-3 text-center">
                <div class="col-sm-4">
                    <label for="familia" class="form-label">Familia</label>
                    <input type="text" class="form-control" name="familia" id="familia" value="<?php echo $planta['familia']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="genero" class="form-label">Género</label>
                    <input type="text" class="form-control" name="genero" id="genero" value="<?php echo $planta['genero']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="especie" class="form-label">Especie</label>
                    <input type="text" class="form-control" name="especie" id="especie" value="<?php echo $planta['especie']; ?>">
                </div>
            </div>
            
            <div class="row my-3 text-center">
                <div class="col-sm-4">
                    <label for="variedad" class="form-label">Variedad</label>
                    <input type="text" class="form-control" name="variedad" id="variedad" value="<?php echo $planta['variedad']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" name="tipo" id="tipo" value="<?php echo $planta['tipo']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="frecuenciaRiego" class="form-label">Frecuencia de Riego (días)</label>
                    <input type="number" class="form-control" id="frecuenciaRiego" name="frecuenciaRiego" min="1" max="7" value="<?php echo $planta['frecuenciaRiego']; ?>" required>
                </div>
            </div>
            
            <div class="row">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"><?php echo $planta['descripcion']; ?></textarea>
            </div>
            
            <hr>
            
            <div class="mb-3">
                <label for="imagen" class="form-label">Selecciona una imagen (opcional):</label>
                <input class="form-control" type="file" name="imagen" id="imagen" accept="image/*">
                <!-- Mostrar imagen actual si existe -->
                <?php if (!empty($planta['imagen'])): ?>
                <div class="mt-2">
                    <img src="uploads/<?php echo $planta['imagen']; ?>" alt="Imagen de la planta" width="100">
                </div>
                <?php endif; ?>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-sm-6 d-flex justify-content-start">
                    <a href="Perfil.html" class="btn btn-outline-warning">Cancelar</a>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
