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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Interfaz Administradores</title>
<style>
    :root {
        --color-primary: <?= $colors['color_primary'] ?>;
        --color-background: <?= $colors['color_background'] ?>;
    }

    form { 
        max-width: 500px;
        margin: auto;
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
        width: 100%; /* Ajusta el ancho de cada columna */
    }

     /* Formulario de dos columnas */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            justify-content: space-between;
        }

        .form-full-width {
            grid-column: span 2;
           justify-content: space-between;
        }

        .form-group {
            margin-bottom: 20px;justify-content: space-between;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--color-secondary);
        }

        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            min-height: 150px;
            font-size: 1rem;
            transition: border-color 0.3s;
           
        }

        .form-group textarea:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            
        }

        .btn-submit {
            grid-column: span 2;
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #0d4a8a;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            padding: 30px;
            align-items: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e6ed;
        }

        .header h1 {
            color: var(--color-primary);
            font-size: 2rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--color-primary);
        }

        /* Tarjeta de contenido */
        .content-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
        }

        .content-card h2 {
            color: var(--color-primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f4f8;
        }

        .intro-text {
            margin-bottom: 25px;
            color: #555;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

</style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navInterfazSuperUser.php';
    ?>

    <div class="container">
        
        <!-- Contenido principal -->
        <div class="main-content">
            <div class="header">
                <h1>Configuración de Interfaz para Administradores</h1>
            </div>
            
            <div class="content-card">
                <h2><i class="fas fa-sliders-h"></i> Personalización de Contenido</h2>
                <p class="intro-text">
                    Personaliza todos los textos visibles para los administradores del sistema. 
                    Puedes modificar los títulos, mensajes de bienvenida y descripciones de las diferentes secciones.
                </p>
                
                <form style="max-width: 1000px; align-items: center; justify-content: space-between;"  action="?controlador=gestionInterfaz&metodo=actualizarInterfazAdmin" method="post">
                    <input type="hidden" name="id" value="<?= $texto['id'] ?>">
                    
                    <div class="form-grid">
                        <!-- Campo de ancho completo -->
                        <div class="form-group">
                         <label><i class="fas fa-align-left"></i> Texto de Bienvenida:</label>
                            <textarea name="texto_inicio" placeholder="Escribe aquí el texto de bienvenida para los administradores..." required><?= htmlspecialchars($texto['texto_inicio']) ?></textarea>
                        </div>
                        
                        <!-- Columna izquierda -->
                        <div class="form-group">
                            <label><i class="fas fa-heading"></i> Título Gestión de Solicitudes:</label>
                            <textarea name="titulo_inicio_solicitudes" placeholder="Ej: Panel de gestión de solicitudes" required><?= htmlspecialchars($texto['titulo_soli_gestion']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-paragraph"></i> Texto Gestión de Solicitudes:</label>
                            <textarea name="texto_inicio_solicitudes" required><?= htmlspecialchars($texto['texto_soli_gestion1']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-list"></i> Título Listado de Solicitudes:</label>
                            <textarea name="titulo_listado_solicitudes" required><?= htmlspecialchars($texto['titulo_lista_soli']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-book"></i> Título Gestión de Cursos:</label>
                            <textarea name="titulo_gestion_cursos" required><?= htmlspecialchars($texto['titulo_curso_gestion']) ?></textarea>
                        </div>
                        
                        <!-- Columna derecha -->
                        <div class="form-group">
                            <label><i class="fas fa-align-left"></i> Texto Adicional Gestión de Solicitudes:</label>
                            <textarea name="texto2_inicio_solicitudes" required><?= htmlspecialchars($texto['texto_soli_gestion2']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-align-left"></i> Texto Gestión de Cursos:</label>
                            <textarea name="texto_inicio_cursos" required><?= htmlspecialchars($texto['texto_curso_gestion1']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-align-left"></i> Texto Adicional Gestión de Cursos:</label>
                            <textarea name="texto2_inicio_cursos" required><?= htmlspecialchars($texto['texto_curso_gestion2']) ?></textarea>
                        </div>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
            
                </form>
            </div>
            
        </div>
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