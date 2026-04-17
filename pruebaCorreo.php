<?php
$to = "jdavid.martin2581@gmail.com"; // Cambia esto a tu dirección de correo
$subject = "Prueba de Envío de Correo";
$message = "Este es un mensaje de prueba enviado desde XAMPP.";
$headers = 'From: jdavid.marti2581@gmail.com'; // Usa una dirección válida

if (mail($to, $subject, $message, $headers)) {
    echo 'Correo enviado correctamente.';
} else {
    echo 'Error al enviar el correo.';
}
?>
