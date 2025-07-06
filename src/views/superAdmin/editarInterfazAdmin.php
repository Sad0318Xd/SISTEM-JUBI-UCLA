<?php
    session_start();
    // Si no existe un usuario autenticado, mostrar su nombre y rol
    if (!isset($_SESSION['rol'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
    }
    include_once __DIR__ . "/../../../config/connection_db.php";

    $sql = "SELECT * FROM interfazadmin WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $texto = $stmt->fetch();

    // Obtener colores actuales
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
    <link rel="stylesheet" href="../src/css/stylegestion2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Solicitar Jubilación</title>
<style>
    :root {
        --color-primary: <?= $colors['color_primary'] ?>;
        --color-background: <?= $colors['color_background'] ?>;
    }

    form { 
        max-width: 500px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Espacio entre columnas */
        justify-content: space-between; 
    }
    
    input[type="text"], input[type="password"] { width: 100%; padding: 8px; }
    input[type="submit"] { margin-top: 15px; padding: 10px; width: 100%; }
    .error { color: red; text-align: center; }

    .formulario {
        display: flex;
        flex-wrap: wrap;
        gap: 100px; /* Espacio entre columnas */
        justify-content: space-between;
    }

    .columna {
        display: flex;
        flex-direction: column;
        width: 45%; /* Ajusta el ancho de cada columna */
    }
</style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navInterfazSuperUser.php';
    ?>

    <div style="width: 1000px; align-items: center;" class="content">

        <h1 style="margin-top: 30px;">aaa</h1>
        <p>estoy arrecho</p>

        <form action="?controlador=gestionInterfaz&metodo=actualizarInterfazAdmin" method="post" style="max-width: 1000px; margin: auto; display: flex; flex-direction: column; gap: 1.5rem;">
            
            <input type="hidden" name="id" value="<?= $texto['id'] ?>">

            <label>
                Texto del inicio:<br>
                <textarea name="texto_inicio" rows="6" style="width: 100%; resize: vertical;" placeholder="Escribe aquí el texto de bienvenida..." required><?=$texto['texto_inicio']?></textarea>
            </label>

            <label>
                Título del inicio de gestión de solicitudes:<br>
                <textarea name="titulo_inicio_solicitudes" rows="4" style="width: 100%; resize: vertical;" placeholder="Ejemplo: Panel de gestión de solicitudes" required><?=$texto['titulo_soli_gestion']?></textarea>
            </label>

            <label>
                Texto del inicio de gestión de solicitudes:<br>
                <textarea name="texto_inicio_solicitudes" rows="6" style="width: 100%; resize: vertical;" required><?=$texto['texto_soli_gestion1']?></textarea>
            </label>

            <label>
                Texto 2 del inicio de gestión de solicitudes:<br>
                <textarea name="texto2_inicio_solicitudes" rows="6" style="width: 100%; resize: vertical;" required><?=$texto['texto_soli_gestion2']?></textarea>
            </label>

            <label>
                Título del listado de solicitudes:<br>
                <textarea name="titulo_listado_solicitudes" rows="3" style="width: 100%; resize: vertical;" required><?=$texto['titulo_lista_soli']?></textarea>
            </label>

            <label>
                Título del inicio de gestión de los cursos:<br>
                <textarea name="titulo_gestion_cursos" rows="3" style="width: 100%; resize: vertical;" required><?=$texto['titulo_curso_gestion']?></textarea>
            </label>

            <label>
                Texto del inicio de gestión de los cursos:<br>
                <textarea name="texto_inicio_cursos" rows="5" style="width: 100%; resize: vertical;" required><?=$texto['texto_curso_gestion1']?></textarea>
            </label>

            <label>
                Texto 2 del inicio de gestión de los cursos:<br>
                <textarea name="texto2_inicio_cursos" rows="5" style="width: 100%; resize: vertical;" required><?=$texto['texto_curso_gestion2']?></textarea>
            </label>

            <button type="submit" style="padding: 12px 24px; font-weight: bold; background-color: #005fab; color: white; border: none; border-radius: 6px; cursor: pointer;">
                Guardar cambios
            </button>

        </form>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'existe'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: 'Ya has enviado una solicitud de jubilación antes.',
                    icon: 'error',
                    confirmButtonText: 'Ver estado',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=solicitud&metodo=solicitud";
                    }
                });
            });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['update']) && $_GET['update'] === 'ok'): ?>
            <script>
                    document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Listo!',
                        text: 'Solicitud enviada correctamente.',
                        icon: 'success',
                        confirmButtonText: 'oki',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                       
                    });
                });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalido'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: 'No cumples con los requisitos para iniciar con tu proceso de jubilación. Verifica que CUMPLES con los AÑOS de servicio o la EDAD correspondiente.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=solicitud&metodo=solicitud";
                    }
                });
            });
            </script>
        <?php endif; ?>
      
</body>
</html>