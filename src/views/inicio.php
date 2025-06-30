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

            if (isset($_SESSION['ci']) || isset($_SESSION['rol'])) {
                
                if(isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'empleado') {
                        include 'navs/navInicioEmpleado.php';

                    } elseif ($_SESSION['rol'] == 'administrador') {
                        include 'navs/navInicioAdmin.php';

                    } elseif ($_SESSION['rol'] == 'superuser') {
                        include 'navs/navInicioSuperUser.php';
                    }
                }
            } else {
                // Si no hay usuario autenticado, mostrar el enlace de login
                include 'navs/navInicio.php';
                
            }

            include_once __DIR__ . "/../../config/connection_db.php";

            $sql = "SELECT texto_inicio FROM interfazempleado WHERE id = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $texto_inicio = $stmt->fetch();

            $sql = "SELECT * FROM interfazadmin WHERE id = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $text_Admin = $stmt->fetch();
        ?>
    </header>
       
    <main>
        <div class="container__background-circule">
            <div class="circule"></div>
        </div>

        <div class="container">
            
            <h1>
                <?php
                // Ejemplo: mostrar contenido distinto según el rol
                if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'superuser') {
                        echo 'Hola, SuperUsuario.';
                    } else {                   
                        echo "Bienvenido, " . $_SESSION['name'] . " " . $_SESSION['lastname'] . ".";
                    }
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
                        echo $text_Admin['texto_inicio'];
                    } elseif ($_SESSION['rol'] == 'empleado') {
                        echo $texto_inicio['texto_inicio'];
                    } elseif ($_SESSION['rol'] == 'superuser') {
                        echo 'Es hora de hacer nuevos cambios.';
                    }
                } else {
                    echo "Solicita tu jubilación de una forma fácil y rápida con unos cuantos clicks.";
                }
                ?>
            </P>
            
            <?php
                if (!isset($_SESSION['rol'])) {
                    // Si no hay usuario autenticado, mostrar los botones
                    include 'buttons.php';
                }
            ?>
        </div>

        <div class="container-img">
            <img   src="
                <?php
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
            <?php
                if (isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'administrador') {
                        echo <<<HTML
                            <img src="../src/img/admin1.png">    
                            HTML;

                    } elseif ($_SESSION['rol'] == 'superuser') {
                        echo <<<HTML
                        <img style="width: 1000px;" src="../src/img/superuser.png">        
                        HTML;
                    }
                }
            ?>
        </div>

        
    </main>
    
    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>