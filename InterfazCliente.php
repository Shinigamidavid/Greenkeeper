<?php
	session_start();
	if(isset($_SESSION['nombre']) && isset($_SESSION['apellido']));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Interfaz Cliente</title>
	<link rel="stylesheet" type="text/css" href="css/estilos_interfazUsuarios.css">
	  <!-- Latest compiled and minified CSS -->
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/estilosGreenkeeper.css">

</head>
<body>
	<header>
		<h1>Cliente</h1>
		<p class="text-success p-4 me-2"><?php echo $_SESSION['nombre'], $_SESSION['apellido'];?></p>
	</header>
	<nav>Barra de Menu</nav>
	<section>
		<article class="texto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</article>
		<article class="texto" >
			<h3>Título</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</article>
		<article >
			<img class="imagen" src="img/imagen1.jpg">
		</article>
	</section>
	<aside>
		<ol class="menu">
			<li><a href="Perfil.php" class="text-warning">perfil</a></li>
			<li><a href="">Opción2</a></li>
			<li><a href="">Opción3</a></li>
			<li><a href="">Opción4</a></li>
			<a href="CerrarSesion.php">Cerrar Sesión</a>
		</ol>
	</aside>
	<footer id="piepag">
		<h2>Información Institucional</h2>
	</footer>
</body>
</html>