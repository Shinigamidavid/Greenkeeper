<?php
	session_start();
	if(isset($_SESSION['nombre']));

	error_reporting(0);

$validar = $_SESSION['nombre'];

if( $validar == null || $validar = ''){

  header("Location: ../Iniciarsesion.php");
  die();
  
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Interfaz Administrador</title>
	<link rel="stylesheet" type="text/css" href="css/estilos_interfazUsuarios.css">
	<!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://kit.fontawesome.com/a53887caa8.js' crossorigin='anonymous'></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
</head>
<body>
	<header>
		<h1>Administrador</h1>
		<p class="text-warning"><?php echo $_SESSION['nombre'];?></p>
	</header>
	<nav>
		<h2>Barra de Navegación</h2>
	</nav>
	<section>
		<article class="texto">
			<iframe src="Registro_usuario.html#formuincio" frameborder="0" allow="fullscreen"></iframe>
			<!-- <iframe src="registro_facturas.html#r_facturas" frameborder="0"></iframe> -->
		</article>
	</section>
	<aside>

		<h5><a href="">Barra Lateral</a></h5>
		<ul class="menu">
			<a href="registro_cliente.html#r_clientes" target="r_clientes"><li>Usuarios</li></a>
			<a href="registro_facturas.html#"><li>Facturas</li></a>
			<li>Opción 3</li>
			<li>Opción 4</li>
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