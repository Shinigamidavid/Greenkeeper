<?php
include 'conexion.php';
session_start();  // Asegúrate de iniciar la sesión

// Verifica si la sesión está activa y obtiene el idUsuario
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];

    // Consulta para obtener los recordatorios del usuario
    $sql = "
        SELECT r.idRecordatorio, r.fecha, r.hora, p.nombreComun, r.proximaFecha AS nombrePlanta, r.estado 
        FROM plantausuario pu
        JOIN recordatorio r ON pu.idRecordatorio = r.idRecordatorio
        JOIN planta p ON pu.idPlanta = p.idPlanta
        WHERE pu.idUsuario = ?
    ";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $recordatorios = [];
    while ($row = $result->fetch_assoc()) {
        // Combinar fecha y hora en un solo string de fecha completa
        $row['fechaHora'] = $row['fecha'] . ' ' . $row['hora'];
        $recordatorios[] = $row;
    }
    $title = 'Vista de Recordatorios';
    $stmt->close();
    $conexion->close();
} else {
    // Guarda la URL actual antes de redirigir
    $_SESSION['urlPrevio'] = $_SERVER['REQUEST_URI'];

    header("location:Iniciarsesion.php?error=No ha iniciado sesión correctamente");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-warning"><?php echo htmlspecialchars($title); ?></h1>
            </div>

            <!-- Tabla de Recordatorios -->
            <div class="col-12">
                <?php if (!empty($recordatorios)): ?>
                    <h3>Tus Recordatorios:</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Planta</th>
                                <th>Id Recordatorio</th>
                                <th>Fecha y Hora</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recordatorios as $recordatorio): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($recordatorio['nombrePlanta']); ?></td>
                                    <td><?php echo htmlspecialchars($recordatorio['idRecordatorio']); ?></td>
                                    <td><?php echo htmlspecialchars($recordatorio['fechaHora']); ?></td>
                                    <td><?php echo htmlspecialchars($recordatorio['estado']); ?></td>
                                    <td>
                                        <button class="btn btn-primary modificarRecordatorio" data-id="<?php echo $recordatorio['idRecordatorio']; ?>">Modificar Recordatorio</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No tienes recordatorios.</p>
                <?php endif; ?>
            </div>

            <!-- Vista de Recordatorios en Tarjetas -->
            <div class="col-12 mt-4">
                <?php foreach ($recordatorios as $recordatorio): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            Recordatorio para planta: <?php echo htmlspecialchars($recordatorio['nombrePlanta']); ?>
                            <div class="float-end">
                                Fecha y hora de alerta: <?php echo htmlspecialchars($recordatorio['fechaHora']); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="wrapper_timer" data-fecha-hora="<?php echo $recordatorio['fechaHora']; ?>">
                                Cargando cuenta regresiva...
                            </div>
                            <button class="btn btn-primary mt-3 modificarRecordatorio" data-id="<?php echo $recordatorio['idRecordatorio']; ?>">Modificar Recordatorio</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script> SOLO CUENTA REGRESIVA
        // Script para calcular y mostrar la cuenta regresiva
        $(document).ready(function() {
            $('.wrapper_timer').each(function() {
                var fechaHora = $(this).data('fecha-hora');
                var countDownDate = new Date(fechaHora).getTime();
                var $this = $(this);

                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    if (distance < 0) {
                        clearInterval(x);
                        $this.text("¡El recordatorio ha pasado!");
                    } else {
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        $this.text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                    }
                }, 1000);
            });
        });
    </script> -->
    <!-- <script> AL ENVIARCORREO.PHP
        $(document).ready(function() {
            $('.wrapper_timer').each(function() {
                var fechaHora = $(this).data('fecha-hora');
                var countDownDate = new Date(fechaHora).getTime();
                var $this = $(this);
                var idRecordatorio = $(this).data('id-recordatorio'); // Asegúrate de tener este dato en el HTML

                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    if (distance < 0) {
                        clearInterval(x);
                        $this.text("¡El recordatorio ha pasado!");

                        // Realizar una solicitud AJAX para enviar el correo
                        $.ajax({
                            url: 'enviarCorreo.php', // Archivo PHP que manejará el envío de correos
                            type: 'POST',
                            data: {
                                idRecordatorio: idRecordatorio
                            },
                            success: function(response) {
                                console.log(response); // Muestra la respuesta en la consola para verificar
                            },
                            error: function(xhr, status, error) {
                                console.error("Error al enviar el correo: " + error);
                            }
                        });
                    } else {
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        $this.text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                    }
                }, 1000);
            });
        });
    </script> -->
    <script>
    $(document).ready(function() {
        $('.wrapper_timer').each(function() {
            var fechaHora = $(this).data('fecha-hora');
            var countDownDate = new Date(fechaHora).getTime();
            var $this = $(this);
            var idRecordatorio = $(this).data('id-recordatorio'); // Asegúrate de tener este dato en el HTML

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                if (distance < 0) {
                    clearInterval(x);
                    $this.text("¡El recordatorio ha pasado!");

                    // Realizar una solicitud AJAX para ejecutar pruebaCorreo.php
                    $.ajax({
                        url: 'pruebaCorreo.php', // Archivo PHP que manejará el envío de correos
                        type: 'POST',
                        success: function(response) {
                            console.log(response); // Muestra la respuesta en la consola para verificar
                        },
                        error: function(xhr, status, error) {
                            console.error("Error al ejecutar pruebaCorreo.php: " + error);
                        }
                    });
                    // Realizar una solicitud AJAX para actualizar el recordatorio
                    $.ajax({
                        url: 'actualizarRecordatorio.php', // Archivo PHP que ejecutará el procedimiento almacenado
                        type: 'POST',
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error al ejecutar actualizarRecordatorio.php: " + error);
                        }
                    });
                } else {
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    $this.text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                }
            }, 1000);
        });
    });
</script>


</body>

</html>
<?php
include 'conexion.php';

// Verifica si la sesión está activa y obtiene el idUsuario
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];

    // Consulta para obtener los recordatorios del usuario
    $sql = "
        SELECT r.idRecordatorio, r.fecha, r.frecuencia, r.estado, proximafecha, p.nombreComun
        FROM recordatorio r
        JOIN plantausuario pu ON r.idRecordatorio = pu.idRecordatorio
        JOIN planta p ON pu.idPlanta = p.idPlanta
        WHERE pu.idUsuario = '$idUsuario'
    ";

    $result = $conexion->query($sql);

    $recordatorios = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recordatorios[] = $row;
        }
    }

    // Mostrar los recordatorios en una tabla debajo del formulario si existen
    if (!empty($recordatorios)) {
        echo '<h3>Tus Recordatorios:</h3>';
        echo '<table class="table">';
        echo '<thead><tr><th>Planta</th><th>Fecha</th><th>Frecuencia</th><th>Estado</th></tr></thead>';
        echo '<tbody>';
        foreach ($recordatorios as $recordatorio) {
            echo '<tr>';
            echo '<td>' . $recordatorio['nombreComun'] . '</td>';
            echo '<td>' . $recordatorio['fecha'] . '</td>';
            echo '<td>' . $recordatorio['frecuencia'] . ' días</td>';
            echo '<td>' . ucfirst($recordatorio['estado']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}
?>