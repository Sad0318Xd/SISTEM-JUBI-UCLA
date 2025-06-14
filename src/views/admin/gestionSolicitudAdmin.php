<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/stylejubiempleado.css">
    <title>Document</title>
</head>
<body>

    <div class="sidebar">
        <h2>Menú</h2>
        <ul class="menu">
            <li><a href="?controlador=VerSolicitud&metodo=VerSolicitud">Solicitudes</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Configuración</a></li>
            <li><a href="?controlador=inicio&metodo=inicio">Salir</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Bienvenido a la página</h1>
        <p>Aquí va el contenido principal...</p>
    </div>

    <?php
            session_start();
            // Si no existe un usuario autenticado, mostrar su nombre y rol
            if (!isset($_SESSION['ci'])) {
                header("Location: index.php?controlador=autenticacion&metodo=login");
            } else {
                // Si no hay usuario autenticado, mostrar el enlace de login
                //echo "Usuario: " . $_SESSION['name'] . " (" . $_SESSION['rol'] . ") | ";
                // Mostrar un enlace para cerrar sesión
                //echo '<a href="?controlador=autenticacion&metodo=logout">Cerrar Sesión</a>';
            }
    ?>
</body>
</html>