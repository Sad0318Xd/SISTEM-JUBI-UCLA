<?php
    session_start();

    // Validar sesión...
    if (!isset($_SESSION['ci'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
        exit;
    }
    include_once __DIR__ . "/../../../config/connection_db.php";

    $sql = "SELECT * FROM color_settings WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $colors = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styleinicio2.css">
    <link rel="stylesheet" href="../src/css/stylecurso2.css">
    <title>Inicio</title>
    <style>
        :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../src/img/logoucla.png" alt="Logo">
            <h1>JUBILACIÓN UCLA</h1>
        </div>

        <?php

            if (isset($_SESSION['ci'])) {
                
                if(isset($_SESSION['rol'])) {
                    if ($_SESSION['rol'] == 'empleado') {
                        include_once __DIR__ . '/../navs/navInicioEmpleado.php';

                    } 
                }
            } else {
                // Si no hay usuario autenticado, mostrar el enlace de login
                include 'navs/navInicio.php';   
            }

            include_once __DIR__ . "/../../../config/connection_db.php";
            $sql = "SELECT * FROM interfazempleado WHERE id = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $texto = $stmt->fetch();
        ?>
    </header>
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
                    if ($_SESSION['rol'] == 'empleado') {
                        echo $texto['texto_curso'];
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
    <main>

        <div class="container__background-circule">
            <div class="circule"></div>
        </div>

        
        <div class="container__cards">
            <?php

                require_once __DIR__ . '/../../../config/connection_db.php';
                require_once __DIR__ . '/../../models/Curso.php';

                // Si no existe un usuario autenticado, mostrar su nombre y rol
                if (!isset($_SESSION['ci'])) {
                    header("Location: index.php?controlador=autenticacion&metodo=login");
                }

                $cursos = new Curso($pdo);
                $cursos = $cursos->CargarCursos();

                while($row = $cursos->fetch()) {
                    // Usar htmlspecialchars para prevenir XSS
                    $titulo = htmlspecialchars($row['titulo']);
                    $descripcion = htmlspecialchars($row['descripcion']);
                    $imagen = htmlspecialchars($row['imagen']);
                    $instructor = htmlspecialchars($row['instructor']);
                    $fecha = htmlspecialchars($row['fecha']);

                    if (!file_exists($imagen)) {
                        echo "La imagen no existe: $imagen";
                    }
                    
                    echo <<<HTML
                    <div class="card">
                        <div class="cover__card">
                            <img src="$imagen" alt="Portada del curso">
                        </div>
                        <h2>$titulo</h2>
                        <p>$descripcion</p>
                        <hr>
                        <div class="footer__card">
                            <h3 class="user__name">$instructor</h3>
                            <i>$fecha</i>
                        </div>
                        <div>
                            <a href="" class="btn__card">Más información</a>
                        </div>
                    </div>
                    HTML;
                }
            ?>
            
            </div>
            
        </div>

    </main>
    
    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>