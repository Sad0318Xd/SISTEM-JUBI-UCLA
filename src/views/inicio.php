<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styleInicio.css">
    <title>Inicio</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../src/img/logoucla.png" alt="Logo">
            <h1>JUBILACIÓN UCLA</h1>
        </div>

        <?php
            session_start();

            if (isset($_SESSION['ci'])) {
                
                if(isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'empleado') {
                        include 'navs/navInicioEmpleado.php';

                    } elseif ($_SESSION['rol'] == 'administrador') {
                        include 'navs/navInicioAdmin.php';
                    }
                }
            } else {
                // Si no hay usuario autenticado, mostrar el enlace de login
                include 'navs/navInicio.php';
                
            }
        ?>
    </header>
    
    <main>

        <div class="container__background-circule">
            <div class="circule"></div>
        </div>

        <!--<p>
        <?php
            // Ejemplo: mostrar contenido distinto según el rol
            if (isset($_SESSION['rol'])) {
                if ($_SESSION['rol'] == 'administrador') {
                    echo "Esta es el contenido exclusivo para administradores.";
                } elseif ($_SESSION['rol'] == 'empleado') {
                    echo "Esta es la información destinada a los empleados.";
                    echo '<a href="?controlador=menuJubilacion&metodo=inicio">Solicitar Jubilación</a>';
                }
            } else {
                echo "Esta es la página de inicio que muestra información importante para el usuario.";
            }
        ?>
        </p> -->

        <div class="container">
            
            <h1>
                <?php
                // Ejemplo: mostrar contenido distinto según el rol
                if (isset($_SESSION['rol'])) {                    
                    echo "BIENVENIDO, " . $_SESSION['name'] . " " . $_SESSION['lastname'] . ".";
                } else {
                    echo "SISTEMA DE JUBILACIÓN UCLA";
                }
                ?>
            </h1>

            <P>
                <?php
                // Ejemplo: mostrar contenido distinto según el rol
                if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'administrador') {
                        echo "¿Deseas hoy modificar las opciones de cursos para los trabajadores o revisar los estados de jubilación?";
                        echo "¡Vamos a ponernos al día!";
                    } elseif ($_SESSION['rol'] == 'empleado') {
                        echo "Selecciona la opción de tu preferencia y accede a una variedad de cursos para que aprendas a llevar la vida después de la jubilación ó puedes solicitar tu jubilación de manera fácil y rápida.";
                    }
                } else {
                    echo "Solicita tu jubilación de una forma fácil y rápida con unos cuantos clicks.";
                }
                ?>
            </P>
            
            <?php
                if (!isset($_SESSION['ci'])) {
                    // Si no hay usuario autenticado, mostrar los botones
                    include 'buttons.php';
                }
            ?>

        </div>

        <div class="container-img">
            <img  src="
            <?php
                // Ejemplo: mostrar contenido distinto según el rol
                if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'empleado') {
                        echo "../src/img/jubilado.png";
                    }
                } else {
                    echo "../src/img/jubilado.png";
                }
                ?>
            ">

            
        </div>
        <div class="container-img-admin">
                <img src="
                <?php
                    if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'administrador') {
                        echo "../src/img/admin1.png";
                    }}
                ?>
            ">
        </div>
    </main>
    
    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>