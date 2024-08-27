<?php
include_once("conexion.php");

$cardsHtml = '';
$sql = "SELECT * FROM ubicacion";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cardsHtml .= '
        <div class="col-md-4">
            <div id="ubicacion" class="card mb-4">
                <img src="' . htmlspecialchars($row['imagen']) . '" class="card-img-top " alt="Imagen">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row['nombre']) . '</h5>
                    <p class="card-text"><strong>Fecha modificación:</strong> ' . htmlspecialchars($row['fecha']) . '</p>
                    <p class="card-text"><strong>Tipo de Entorno:</strong> ' . htmlspecialchars($row['tipo']) . '</p>
                    <p class="card-text"><strong>Id Ubi:</strong> ' . htmlspecialchars($row['idUbicacion']) . '</p>
                   
                </div>
            </div>
        </div>';
    }
}

echo $cardsHtml;
?>


        