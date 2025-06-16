<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/stylegestion.css">
    <title>Jubilación para Empleados</title>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navCursosAdmin.php';
    ?>

    <div class="content">

        <h1>Sistema de <span class="highlight">Gestión de Cursos</span></h1>
        <p>Este sistema permite agregar y realizar modificaciones a los cursos anteriormente agregados para que todos los usuarios empleados del sistema tengan acceso a ellos.</p>
        <p>Utilice el menú lateral para navegar por las diferentes opciones disponibles. Los botones de <span class="highlight">Volver</span> y <span class="highlight">Cerrar Sesión</span> se encuentran fijos en la parte inferior del menú para un acceso fácil y consistente.</p>
    
    </div>
    
    <?php
        session_start();
        // Si no existe un usuario autenticado, mostrar su nombre y rol
         if (!isset($_SESSION['ci'])) {
            header("Location: index.php?controlador=autenticacion&metodo=login");
        } else {

        }
    ?>

    
</body>
</html>