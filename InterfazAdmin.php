<?php
session_start();

// Validar que el usuario esté autenticado
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] == '') {
    header("Location: ../Iniciarsesion.php");
    die();
}

include 'conexion.php';
// Obtener el idUsuario del usuario autenticado
$idUsuario = $_SESSION['idUsuario']; // Asegúrate de que 'idUsuario' esté en la sesión

// Consultar el nombre del rol en la base de datos
$query = "SELECT r.nombre
          FROM usuario u
          JOIN rol r ON u.idRol = r.idRol
          WHERE u.idUsuario = $idUsuario";

// Ejecutar la consulta
$result = $conexion->query($query);

if ($result) {
    // Obtener el nombre del rol
    $row = $result->fetch_assoc();
    $_SESSION['rol'] = $row['nombre'];
} else {
    // Manejar el error en caso de fallo en la consulta
    echo "Error en la consulta: " . $conexion->error;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Interfaz Administrador</title>
	<link rel="stylesheet" href="css/estilosInterfazAdmin.css">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src='https://kit.fontawesome.com/a53887caa8.js' crossorigin='anonymous'></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
</head>

<body>
	<header>
		<h1>Administrador</h1>
		<p class="text-warning"><?php echo $_SESSION['rol']; ?></p>
	</header>
	<nav>
		<h2>Barra de Navegación</h2>
	</nav>
	<section>
		<article class="texto">
			<iframe src="Registro_usuario.html#formu" frameborder="0" allow="fullscreen"></iframe>
			<!-- <iframe src="registro_facturas.html#r_facturas" frameborder="0"></iframe> -->
		</article>
	</section>
	<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <!-- Reemplazamos el contenido con el nuevo <section> -->
        <section>
            <article class="texto">
                <iframe src="Registro_usuario.html#formuincio" frameborder="0" allow="fullscreen" style="width: 100%; height: 500px;"></iframe>
            </article>
        </section>
    </div>
    <div class="card-footer">
        <!-- Puedes mantener los enlaces de la tarjeta aquí -->
        <a href="#" class="card-link">Ver mis Ubicaciones</a>
        <a href="Añadir_ubicacion.html" class="card-link">Añadir una ubicación</a>
    </div>
</div>

	<aside>

		<h5><a href="">Barra Lateral</a></h5>
		<ul class="menu">
			<a href="Registro_usuario.html#r_clientes" target="r_clientes">
				<li>Usuarios</li>
			</a>
			<a href="consulta_clientes.php" target="r_clientes">
				<li>Consultar Usuarios</li>
			</a>
			<a href="registro_facturas.html#">
				<li>Facturas</li>
			</a>
			<li>Opción 3</li>
			<a href="Registro_planta.html#r_planta" target="r_planta">
				<li>Registrar una Planta</li>
			</a>
			<a href="CerrarSesion.php">Cerrar Sesión</a>
		</ul>
	</aside>

	<footer id="piepag">
		<h4>Pie de Página</h4>
		<p>Dirección</p>
		<p>Teléfono</p>
	</footer>
</body>

</html>