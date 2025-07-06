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
    <link rel="stylesheet" href="../src/css/stylecurso2.css">
    <link rel="stylesheet" href="../src/css/stylegestion2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Agregar un Curso</title>
    <style>
        :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
    </style>
</head>
<body>
    <main>

        <?php
            include __DIR__ . '/../navs/navCursosAdmin.php';
        ?>

        <section class="content">
            
            <h1>Agregar un nuevo Curso</h1>

            <form 
                action="?controlador=cursos&metodo=agregarCurso" 
                method="post" 
                enctype="multipart/form-data"
            >
                
                <label>Título:<br>
                <input type="text" name="titulo" 
                        value="" required>
                </label><br><br>
                
                <label>Descripción:<br>
                <textarea class="textarea" name="descripcion" rows="5" required></textarea>
                </label><br><br>
                
                <label>Instructor:
                <input type="text" name="instructor" 
                        value="" required>
                </label><br><br>
                
                <label>Fecha:
                <input type="date" name="fecha" 
                        value="" required>
                </label><br><br>
                
                <!-- Vista previa de la imagen actual -->
                <label>Imagen actual:<br>
                    <img src="<?= $curso['imagen'] ?>" width="200"><br>
                    <em>No hay imagen</em><br>
                </label><br>
                
                <label>Subir nueva imagen:<br>
                <input type="file" name="imagen" required>          
                <small>(png/jpg, max 2 MB)</small>
                </label><br><br>
                
                <input type="submit">
            </form>
        </section>
    </main>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'agregado'): ?>
        <script>
            Swal.fire({
                title: '¡Listo!',
                text: 'Curso agregado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = "index.php?controlador=gestionCursos&metodo=AgregarCursosVistaAdmin";
            });
        </script>
    <?php endif; ?>

</body>
</html>