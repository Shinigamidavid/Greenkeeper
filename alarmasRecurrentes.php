<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alarmas Recurrentes</title>
    <style>
        .alarm {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Alarmas Recurrentes</h1>
    <div id="alarms-container"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alarms = [
                {
                    id: 1,
                    time: '2024-07-16T17:00:00',
                    frequency: 1 // en días
                },
                {
                    id: 2,
                    time: '2024-07-16T17:00:00',
                    frequency: 3 // en días
                }
            ];

            alarms.forEach(alarm => createAlarm(alarm));

            function createAlarm(alarm) {
                const alarmDiv = document.createElement('div');
                alarmDiv.className = 'alarm';
                alarmDiv.innerHTML = `
                    <p>Alarma ${alarm.id}: <span id="alarm-${alarm.id}">${new Date(alarm.time).toLocaleString()}</span></p>
                `;
                document.getElementById('alarms-container').appendChild(alarmDiv);

                scheduleAlarm(alarm);
            }

            function scheduleAlarm(alarm) {
                const now = new Date();
                const alarmTime = new Date(alarm.time);
                const delay = alarmTime - now;

                if (delay > 0) {
                    setTimeout(() => {
                        triggerAlarm(alarm);
                    }, delay);
                } else {
                    console.log(`La hora de la alarma ${alarm.id} ya ha pasado.`);
                }
            }

            function triggerAlarm(alarm) {
                alert(`¡Alarma ${alarm.id}!`);
                // Aquí puedes añadir la lógica para la repetición de la alarma
                repeatAlarm(alarm);
            }

            function repeatAlarm(alarm) {
                const nextAlarmTime = new Date(alarm.time);
                nextAlarmTime.setDate(nextAlarmTime.getDate() + alarm.frequency);

                alarm.time = nextAlarmTime.toISOString();
                document.getElementById(`alarm-${alarm.id}`).innerText = nextAlarmTime.toLocaleString();

                scheduleAlarm(alarm);
            }
        });
    </script>
</body>
</html>


// 
<hr> -->

<?php
 require 'conexion.php';


// Obtener la hora actual
$now = new DateTime();

// Consultar alarmas
$sql = "SELECT idRecordatorio, hora, fecha, frecuenciaRiego FROM recordatorio";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $alarm_time = new DateTime($row['time']);
        $frequency = $row['frequency'];

        // Verificar si la alarma debe dispararse
        if ($now >= $alarm_time) {
            // Ejecutar la acción de la alarma (por ejemplo, enviar un correo)
            echo "¡Alarma " . $row['id'] . "!";

            // Calcular la próxima alarma
            $next_alarm_time = $alarm_time->modify("+$frecuenciaRiego day");

            // Actualizar la hora de la próxima alarma en la base de datos
            $update_sql = "UPDATE alarms SET time='" . $next_alarm_time->format('Y-m-d H:i:s') . "' WHERE id=" . $row['id'];
            $conexion ->query($update_sql);
        }
    }
} else {
    echo "No hay alarmas programadas.";
}

$conexion ->close();
?>

