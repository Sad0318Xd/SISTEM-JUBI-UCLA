<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styleinicio.css">
    <link rel="stylesheet" href="../src/css/stylecursos.css">
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
                        include_once __DIR__ . '/../navs/navInicioEmpleado.php';

                    } 
                }
            } else {
                // Si no hay usuario autenticado, mostrar el enlace de login
                include 'navs/navInicio.php';   
            }
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
                    if ($_SESSION['rol'] == 'administrador') {
                        echo "¿Deseas hoy modificar las opciones de cursos para los trabajadores o revisar los estados de jubilación?";
                        echo "¡Vamos a ponernos al día!";
                    } elseif ($_SESSION['rol'] == 'empleado') {
                        echo "Accede a nuestra variedad de cursos desarrollados especialmente para tí, para que apredas a lidiar con tu post-jubilación. Te ofrecemos todo tipo de cursos y que estan a tu disposicón.";
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
                // Si no existe un usuario autenticado, mostrar su nombre y rol
                if (!isset($_SESSION['ci'])) {
                    header("Location: index.php?controlador=autenticacion&metodo=login");
                } 
                $sql = "SELECT * FROM cursos";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                
                

                while($row = $stmt->fetch()) {
                    // Usar htmlspecialchars para prevenir XSS
                    $titulo = htmlspecialchars($row['titulo']);
                    $descripcion = htmlspecialchars($row['descripcion']);
                    $imagen = htmlspecialchars($row['imagen']);
                    $instructor = htmlspecialchars($row['instructor']);
                    $fecha = htmlspecialchars($row['fecha']);

                    $rutaimg = $imagen;

                    if (!file_exists($rutaimg)) {
                        echo "La imagen no existe: $rutaimg";
                    }
                    
                    echo <<<HTML
                    <div class="card">
                        <div class="cover__card">
                            <img src="$rutaimg" alt="Portada del curso">
                        </div>
                        <h2>$titulo</h2>
                        <p>$descripcion</p>
                        <hr>
                        <div class="footer__card">
                            <h3 class="user__name">$instructor</h3>
                            <i>$fecha</i>
                        </div>
                    </div>
                    HTML;
                }
            ?>
            <div class="card">
                <div class="cover__card">
                    <img src="../src/img/cursos/img-1.jpg" alt="">
                </div>
                <h2>Sabemos cómo aumentar los beneficios</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui sunt eius dolore pariatur. Error, provident et similique sunt voluptate odit eos facere expedita, culpa at officia magnam quia vel eius!</p>
                <hr>
                <div class="footer__card">
                    <h3 class="user__name">Mamie Barnett</h3>
                    <i>08 Marzo</i>
                </div>
            </div>
            <div class="card">
                <div class="cover__card">
                    <img src="images/img-2.jpg" alt="">
                </div>
                <h2>Sabemos cómo aumentar los beneficios</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui sunt eius dolore pariatur. Error, provident et similique sunt voluptate odit eos facere expedita, culpa at officia magnam quia vel eius!</p>
                <hr>
                <div class="footer__card">
                    <h3 class="user__name">Mamie Barnett</h3>
                    <i>08 Marzo</i>
                </div>
            </div>
            <div class="card">
                <div class="cover__card">
                    <img src="images/img-3.jpg" alt="">
                </div>
                <h2>Sabemos cómo aumentar los beneficios</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui sunt eius dolore pariatur. Error, provident et similique sunt voluptate odit eos facere expedita, culpa at officia magnam quia vel eius!</p>
                <hr>
                <div class="footer__card">
                    <h3 class="user__name">Mamie Barnett</h3>
                    <i>08 Marzo</i>
                </div>
            </div>
            
        </div>

    </main>
    
    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>