<?php
include_once("conexion.php");

// Inicializa el contenido de las tarjetas
$cardsHtml = '';
$sql = "
    SELECT 
        p.nombreComun, 
        p.tipo, 
        p.genero, 
        pu.fechaPlantacion, 
        pu.estado, 
        u.nombre AS usuarioNombre, 
        r.proximaFecha, 
        pu.fechaCreacion, 
        r.frecuencia, 
        p.imagen 
    FROM 
        plantaUsuario pu
    INNER JOIN 
        usuario u ON pu.idUsuario = u.idUsuario
    INNER JOIN 
        planta p ON pu.idPlanta = p.idPlanta
    INNER JOIN 
        recordatorio r ON pu.idRecordatorio = r.idRecordatorio
";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $card_count = 0;
    $first = true;

    while ($row = $result->fetch_assoc()) {
        // Abrir nuevo carousel-item cada 3 tarjetas
        if ($card_count % 3 == 0) {
            if (!$first) {
                $cardsHtml .= '</div></div>'; // Cerrar el carousel-item anterior
            }
            $cardsHtml .= '<div class="carousel-item' . ($first ? ' active' : '') . '"><div class="cards-wrapper d-flex">';
            $first = false;
        }

        // Estructura de la tarjeta
        $cardsHtml .= '
        <div class="card mx-2" style="width: 30%;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="' . htmlspecialchars($row['imagen']) . '" class="img-fluid" alt="Imagen" style="object-fit: cover;">
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
            </div>
        </div>';

        $card_count++;

        // Cerrar el carousel-item cada 3 tarjetas
        if ($card_count % 3 == 0) {
            $cardsHtml .= '</div></div>';
        }
    }

    // Cerrar el último carousel-item si hay tarjetas restantes
    if ($card_count % 3 != 0) {
        $cardsHtml .= '</div></div>';
    }
}
echo $cardsHtml;
?>
