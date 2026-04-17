<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION['correo'])) {
    $_SESSION['urlPrevio'] = $_SERVER['REQUEST_URI']; // Captura la URL actual
    header('Location: Iniciarsesion.php?error=Debe iniciar sesion Admin');
    exit();
}
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

// Realizar la consulta usuarios
$sql = "SELECT COUNT(*) AS totalUsuarios FROM usuario";
$result = $conexion->query($sql);

// Obtener el resultado
$totalUsuarios = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsuarios = $row['totalUsuarios'];
} else {
    $totalUsuarios = 0;
}
// Consulta total plantas 
$sql = "SELECT COUNT(*) AS totalPlantas from planta";
$result = $conexion->query($sql);
$totalPlantas = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPlantas = $row['totalPlantas'];
} else {
    $totalPlantas = 0;
}
// Consulta total recordatorio 
$sql = "SELECT COUNT(*) AS totalRecordatorios from recordatorio";
$result = $conexion->query($sql);
$totalRecordatorio = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalRecordatorios = $row['totalRecordatorios'];
} else {
    $totalRecordatorios = 0;
} // Consulta total ubicaciones 
$sql = "SELECT COUNT(*) AS totalUbicaciones from ubicacion";
$result = $conexion->query($sql);
$totalUbicaciones = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUbicaciones = $row['totalUbicaciones'];
} else {
    $totalUbicaciones = 0;
}



$fecha_actual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- estilos administrador -->
    <link rel="stylesheet" href="css/StyleAdmin.css">
    <link rel="stylesheet" href="css/estilosGreenkeeper.css">

    <title>Interfaz de Administración</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/812f294f45.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="leaf-outline"></ion-icon> </span>
                        <span class="title">GREEN KEEPER</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="interfazA.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Panel Principal</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" id="usuarios-link">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Usuarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="registrarUsu-link">
                        <span class="icon">
                            <ion-icon name="person-add-outline"></ion-icon> </span>
                        <span class="title">Nuevo Usuario</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" id="recordatorios-link">
                        <span class="icon">
                            <ion-icon name="stopwatch-outline"></ion-icon> </span>
                        <span class="title">Recordatorios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="plantas-link">
                        <span class="icon">
                            <ion-icon name="leaf-outline"></ion-icon> </span>
                        <span class="title">Plantas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="ubicaciones-link">
                        <span class="icon">
                            <ion-icon name="compass-outline"></ion-icon> </span>
                        <span class="title">Ubicaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="añadirUbi-link">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Añadir Ubicación</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" id="registrarPlanta-link">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Registrar una Planta</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon> </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="CerrarSesion.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon> </span>
                        <span class="title">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ===== Main ===== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <p class="text-info"><?php echo $_SESSION['rol']; ?></p>
                <p class="text-warning p-4"><?php echo $_SESSION['idUsuario'] . " " . $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></p>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user">
                    <img src="img/tyrion lannister.jpg" alt="">
                </div>
            </div>

            <!-- ===== Cards ===== -->
            <div id="content-area">
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $totalUsuarios; ?></div>
                            <div class="cardName">Total de Usuarios</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $totalPlantas; ?></div>
                            <div class="cardName">Plantas Registradas</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="leaf-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $totalRecordatorios; ?></div>
                            <div class="cardName">Recordatorios</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="timer-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $totalUbicaciones; ?></div>
                            <div class="cardName">Ubicaciones</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="map-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                <!-- ===== Order Details List ===== -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Recent Reminders</h2>
                            <a href="a" class="btn">View All</a>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td>Nombre Usuario</td>
                                    <td>Nombre Planta</td>
                                    <td>Proxima Fceha</td>
                                    <td>Hora</td>
                                    <td>Estado</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // Realizar la consulta a la vista para obtener los últimos 4 recordatorios
                                $sql = "SELECT Nombre_Usuario, Nombre_planta, Proxima_Fecha, Hora, Estado_Recordatorio 
                        FROM lista_recordatorios 
                        ORDER BY Fecha_Creacion DESC 
                        LIMIT 4";
                                $result = $conexion->query($sql);

                                // Verificar si hay resultados
                                if ($result->num_rows > 0) {
                                    // Recorrer los resultados y generar las filas de la tabla
                                    while ($row = $result->fetch_assoc()) {
                                        $nombreUsuario = $row['Nombre_Usuario'];
                                        $nombrePlanta = $row['Nombre_planta'];
                                        $proximaFecha = $row['Proxima_Fecha'];
                                        $hora = $row['Hora'];
                                        $estadoRecordatorio = $row['Estado_Recordatorio'];

                                        // Determinar la clase de estado según el valor de Estado_Recordatorio
                                        if ($estadoRecordatorio == 'on') {
                                            $statusClass = 'delivered'; // Verde
                                            $statusText = 'On';
                                        } elseif ($estadoRecordatorio == 'off') {
                                            $statusClass = 'return'; // Rojo
                                            $statusText = 'Off';
                                        } else {
                                            $statusClass = 'inProgress'; // Amarillo
                                            $statusText = 'No Status';
                                        }

                                        // Generar la fila HTML con los datos
                                        echo '
                        <tr>
                            <td>' . htmlspecialchars($nombreUsuario) . '</td>
                            <td>' . htmlspecialchars($nombrePlanta) . '</td>
                            <td>' . htmlspecialchars($proximaFecha) . '</td>
                            <td>' . htmlspecialchars($hora) . '</td>
                            <td><span class="status ' . $statusClass . '">' . $statusText . '</span></td>
                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5">No reminders found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Recent Orders</h2>
                            <a href="a" class="btn">View All</a>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Price</td>
                                    <td>Payment</td>
                                    <td>Status</td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Start Refrigerator</td>
                                    <td>$1200</td>
                                    <td>Paid</td>
                                    <td><span class="status delivered">Delivered</span></td>
                                </tr>

                                <tr>
                                    <td>Dell Laptop</td>
                                    <td>$110</td>
                                    <td>Due</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>Apple Watch</td>
                                    <td>$1200</td>
                                    <td>Paid</td>
                                    <td><span class="status return">Return</span></td>
                                </tr>

                                <tr>
                                    <td>Addidas Shoes</td>
                                    <td>$620</td>
                                    <td>Due</td>
                                    <td><span class="status inProgress">In Progress</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->

                    <!-- ===== New Costumers ===== -->
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Usaurios Recientes</h2>
                        </div>

                        <table>
                            <?php
                            // Consulta para obtener los últimos 6 usuarios registrados junto con su rol
                            $sql = "SELECT u.nombre, u.sexo, r.nombre AS nombreRol 
                FROM usuario u
                JOIN rol r ON u.idRol = r.idRol
                ORDER BY u.idUsuario DESC
                LIMIT 6";
                            $result = $conexion->query($sql);

                            // Verificar si hay resultados
                            if ($result->num_rows > 0) {
                                // Iterar sobre los resultados y generar las filas de la tabla
                                while ($row = $result->fetch_assoc()) {
                                    $nombreUsuario = $row['nombre'];
                                    $sexo = $row['sexo'];
                                    $nombreRol = $row['nombre'];

                                    // Generar la fila para cada usuario
                                    echo '
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="img/default.jpg" alt="Imagen"></div>
                    </td>
                    <td>
                        <h4>' . htmlspecialchars($nombreUsuario) . ' <br> 
                            <span>' . htmlspecialchars($sexo) . '</span> <br>
                            <span>' . htmlspecialchars($nombreRol) . '</span>
                        </h4>
                    </td>
                </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">No se encontraron usuarios recientes.</td></tr>';
                            }
                            ?>
                        </table>
                    </div>

                    <!-- <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Recent Customers</h2>
                        </div>

                        <table>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="img/daenerys targaryen.jpg.webp" alt=""></div>
                                </td>
                                <td>
                                    <h4>Daenerys <br> <span>Italy</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="img/Rasta.jpg" alt=""></div>
                                </td>
                                <td>
                                    <h4>David <br> <span>India</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="img/daenerys targaryen.jpg.webp" alt=""></div>
                                </td>
                                <td>
                                    <h4>Daenerys <br> <span>Colombia</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="img/tyrion lannister.jpg" alt=""></div>
                                </td>
                                <td>
                                    <h4>Tyrion <br> <span>India</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="img/daenerys targaryen.jpg.webp" alt=""></div>
                                </td>
                                <td>
                                    <h4>Daenerys <br> <span>Italy</span></h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="img/Rasta.jpg" alt=""></div>
                                </td>
                                <td>
                                    <h4>Daenerys <br> <span>Italy</span></h4>
                                </td>
                            </tr>
                        </table>
                    </div> -->

                </div>
            </div>
            <script>
                // Manejar el clic en los enlaces
                document.getElementById('registrarUsu-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de Registro_usuario.html
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="Registro_usuario.html#formuincio" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });
                document.getElementById('usuarios-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de consulta_clientes.php
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="consulta_clientes.php" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });

                document.getElementById('recordatorios-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de consulta_clientes.php
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="consulta_recordatorios.php" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });
                document.getElementById('ubicaciones-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de consulta_clientes.php
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="Mis_ubicaciones.html" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });
                document.getElementById('añadirUbi-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de consulta_clientes.php
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="Añadir-ubicacion.php" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });

                document.getElementById('registrarPlanta-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de consulta_clientes.php
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="Registro_planta.html" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });
                document.getElementById('plantas-link').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                    // Reemplazar el contenido de #content-area con el contenido de consulta_clientes.php
                    document.getElementById('content-area').innerHTML = `
            <section>
                <article class="texto">
                    <iframe src="consultar_plantas.php" frameborder="0" allow="fullscreen" style="width: 100%; height: 628px;"></iframe>
                </article>
            </section>
        `;
                });
            </script>

        </div>

    </div>
    <!-- ====== Scripts ===== -->
    <script src="js/main.js"></script>



    <!-- ===== ionicons ===== -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>