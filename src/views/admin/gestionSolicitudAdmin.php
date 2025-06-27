<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/stylegestion.css">
    <title>Gestión de Solicitudes</title>
</head>
<body>

    <?php
            include __DIR__ . '/../navs/navSolicitudAdmin.php';
    ?>

    <div class="content">
        <h1>Bienvenido a la página</h1>
        <p>Este sistema permite administrar las solicitudes de jubilación, como <span class="highlight">Procesar</span> el estado de los trámites y gestionar toda la documentación de manera eficiente y segura.</p>
        <p>Utilice el menú lateral para navegar por las diferentes opciones disponibles. Los botones de <span class="highlight">Volver</span> y <span class="highlight">Cerrar Sesión</span> se encuentran fijos en la parte inferior del menú para un acceso fácil y consistente.</p>
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