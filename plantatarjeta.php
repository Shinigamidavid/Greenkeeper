<?php
include_once("conexion.php");

$cardsHtml = '';
$sql = "SELECT * FROM planta";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cardsHtml .= '
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="' . htmlspecialchars($row['imagen']) . '" class="card-img-top" alt="Imagen">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row['nombreComun']) . '</h5>
                    <p class="card-text"><strong>Nombre científico:</strong> ' . htmlspecialchars($row['nombreCientifico']) . '</p>
                    <p class="card-text"><strong>Familia:</strong> ' . htmlspecialchars($row['familia']) . '</p>
                    <p class="card-text"><strong>Género:</strong> ' . htmlspecialchars($row['genero']) . '</p>
                    <p class="card-text"><strong>Especie:</strong> ' . htmlspecialchars($row['especie']) . '</p>
                    <p class="card-text"><strong>Variedad:</strong> ' . htmlspecialchars($row['variedad']) . '</p>
                    <p class="card-text"><strong>Tipo:</strong> ' . htmlspecialchars($row['tipo']) . '</p>
                    <p class="card-text"><strong>Frecuencia de Riego cada:</strong> ' . htmlspecialchars($row['frecuenciaRiego']) . '<strong>Dias</strong></p>

                    <p class="card-text"><strong>Descripción:</strong> ' . htmlspecialchars($row['descripcion']) . '</p>
                </div>
            </div>
        </div>';
    }
}

echo $cardsHtml;
?>
