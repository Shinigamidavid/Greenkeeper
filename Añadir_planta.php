<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'greenkeeper1');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO ubicacion (IdUbicacion, nombre, tipo, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $idUbicacion, $nombre, $tipo, $imagen);

    // Set parameters and execute
    $idUbicacion = $_POST['IdUbicacion'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $imagen = $_POST['imagen'];

    if ($stmt->execute()) {
        echo "New location registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Include your HTML form here -->