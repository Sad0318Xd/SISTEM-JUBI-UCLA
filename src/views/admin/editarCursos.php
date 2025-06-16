<?php
    require_once __DIR__ . '/../../../config/connection_db.php';
    session_start();

    // Validar sesión...
    if (!isset($_SESSION['ci'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
        exit;
    }

    if (!isset($_GET['id'])) {
        die("ID de curso no especificado");
    }
    $id = (int) $_GET['id'];

    // 1) Traer datos actuales
    $sql = "SELECT * FROM cursos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $curso = $stmt->fetch();

    if (!$curso) {
        die("Curso no encontrado");
    }
    
?>
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
            
            <h1>Editar Curso: <?= htmlspecialchars($curso['titulo']) ?></h1>

            <form 
                action="?controlador=actualizarCurso&metodo=ActualizarCurso" 
                method="post" 
                enctype="multipart/form-data"
            >
                <input type="hidden" name="id" value="<?= $curso['id'] ?>">
                
                <label>Título:<br>
                <input type="text" name="titulo" 
                        value="<?= htmlspecialchars($curso['titulo']) ?>" required>
                </label><br><br>
                
                <label>Descripción:<br>
                <textarea class="textarea" name="descripcion" rows="5" required><?= 
                    htmlspecialchars($curso['descripcion']) ?></textarea>
                </label><br><br>
                
                <label>Instructor:
                <input type="text" name="instructor" 
                        value="<?= htmlspecialchars($curso['instructor']) ?>" required>
                </label><br><br>
                
                <label>Fecha:
                <input type="date" name="fecha" 
                        value="<?= $curso['fecha'] ?>" required>
                </label><br><br>
                
                <!-- Vista previa de la imagen actual -->
                <label>Imagen actual:<br>
                <?php if ($curso['imagen'] && file_exists($curso['imagen'])): ?>
                    <img src="<?= $curso['imagen'] ?>" width="200"><br>
                <?php else: ?>
                    <em>No hay imagen</em><br>
                <?php endif; ?>
                </label><br>
                
                <label>Subir nueva imagen:<br>
                <input type="file" name="imagen">          
                <small>(png/jpg, max 2 MB)</small>
                </label><br><br>
                
                <input type="submit">
            </form>
        </section>
    </main>

</body>
</html>