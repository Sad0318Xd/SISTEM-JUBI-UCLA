<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/stylecurso.css">
    <link rel="stylesheet" href="../src/css/stylegestion.css">
    <title>Inicio</title>
</head>
<body>
    <main>

        <?php
            include __DIR__ . '/../navs/navCursosAdmin.php';
        ?>
    
        <section class="content">
    
            <div class="container__cards">
                <?php
                    session_start();
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
                            <div class="footer__card">
                                <a href="?controlador=editarCursos&metodo=editarCursos&id={$row['id']}">Editar</a>
                                <a href="?controlador=editarCursos&metodo=editarCursos&id={$row['id']}">Eliminar</a>
                            </div>
                        </div>
                        HTML;
                    }
                ?>   
                   
                
            </div>

        </section>
    </main>

</body>
</html>