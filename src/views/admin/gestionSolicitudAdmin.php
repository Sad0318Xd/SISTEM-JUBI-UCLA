<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/stylegestion1.css">
    <title>Gestión de Solicitudes</title>
</head>
<body>

    <?php
            include __DIR__ . '/../navs/navSolicitudAdmin.php';
    ?>

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