<?php
include 'conexion.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_GET['nombreComun'])) {
    $nombreComun = $conexion->real_escape_string($_GET['nombreComun']);
    $sql = "
        SELECT p.nombreComun, p.tipo, p.genero, pu.fechaPlantacion, pu.estado, u.nombre AS usuarioNombre, 
               r.proximaFecha, pu.fechaCreacion, p.imagen, r.frecuencia
        FROM plantaUsuario pu
        LEFT JOIN planta p ON pu.idPlanta = p.idPlanta
        LEFT JOIN recordatorio r ON pu.idRecordatorio = r.idRecordatorio
        LEFT JOIN ubicacion u ON pu.idUbicacion = u.idUbicacion
        WHERE p.nombreComun LIKE '%$nombreComun%'
    ";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '
        <div class="row">
            <div class="col-md-4">
                <img src="' . htmlspecialchars($row['imagen']) . '" class="img-fluid" alt="Imagen">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row['nombreComun']) . '</h5>
                    <p class="card-text"><strong>Tipo:</strong> ' . htmlspecialchars($row['tipo']) . '</p>
                    <p class="card-text"><strong>Género:</strong> ' . htmlspecialchars($row['genero']) . '</p>
                    <p class="card-text"><strong>Fecha de Plantación:</strong> ' . htmlspecialchars($row['fechaPlantacion']) . '</p>
                    <p class="card-text"><strong>Estado:</strong> ' . htmlspecialchars($row['estado']) . '</p>
                    <p class="card-text"><strong>Usuario:</strong> ' . htmlspecialchars($row['usuarioNombre']) . '</p>
                    <p class="card-text"><strong>Próxima Fecha de Riego:</strong> ' . htmlspecialchars($row['proximaFecha']) . '</p>
                    <p class="card-text"><strong>Fecha de Creación del Recordatorio:</strong> ' . htmlspecialchars($row['fechaCreacion']) . '</p>
                    <p class="card-text"><strong>Frecuencia de Riego cada:</strong> ' . htmlspecialchars($row['frecuencia']) . ' días</p>
                </div>
            </div>
        </div>';
    } else {
        echo '<p>No se encontraron resultados.</p>';
    }
} else {
    echo '<p>Error: No se proporcionó un nombre común.</p>';
}

$conexion->close();
?>
