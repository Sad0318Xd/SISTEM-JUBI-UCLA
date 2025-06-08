<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
 <style>
        body { font-family: Arial, sans-serif;  }
        header { background-color: #f4f4f4; padding: 10px; }
        nav a { text-decoration: none; color: #333; }
        footer { margin-top: 20px; font-size: 0.9em; color: #666; }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #2c3e50;
            color: white;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px; /* Ajusta el tamaño del logo */
            margin-right: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #f39c12; /* Efecto hover */
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
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

        <section>
            
            <h1>
                <?php
                // Ejemplo: mostrar contenido distinto según el rol
                if (isset($_SESSION['rol'])) {                    
                    echo "BIENVENIDO, " . $_SESSION['name'] . " " . $_SESSION['lastname'] . ".";
                } else {
                    echo "SISTEMA DE JUBILACIÓN UCLA.";
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

        </section>

        <section>
            <img src="
            <?php
                // Ejemplo: mostrar contenido distinto según el rol
                if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'administrador') {
                        echo "../src/img/admins.png";
                    } elseif ($_SESSION['rol'] == 'empleado') {
                        echo "../src/img/jubilados.png";
                    }
                } else {
                    echo "../src/img/jubilados.png";
                }
                ?>
            " alt="admins">
        </section>
    </main>
    
    <footer>
        &copy; 2025 Mi Sitio Web
    </footer>
</body>
</html>