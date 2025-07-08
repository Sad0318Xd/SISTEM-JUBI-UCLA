<?php
    session_start();
    // Si no existe un usuario autenticado, mostrar su nombre y rol
    if (!isset($_SESSION['rol'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
    }
    include_once __DIR__ . "/../../../config/connection_db.php";
    
    // Obtener colores actuales
    $sql = "SELECT * FROM color_settings WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $colors = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/stylegestion2.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Configuración de Colores</title>
    <style>
        :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--color-background);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }
        
        .color-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            max-width: 800px;
            align-items: center;
        }
        
        h2 {
            color: var(--color-primary);
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .color-label {
            flex: 1;
            font-weight: 600;
            color: var(--text);
            display: flex;
            align-items: center;
        }
        
        .color-preview {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        .color-input {
            flex: 3;
            display: flex;
            gap: 10px;
        }
        
        .color-input input[type="color"] {
            width: 60px;
            height: 40px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .color-input input[type="text"] {
            flex: 1;
            padding: 10px 15px;
            border: 2px solid #e1e5eb;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
        }
        
        button {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 14px 25px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s ease;
        }
        
        button:hover {
            background: var(--color-primary-light);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .color-example {
            display: flex;
            margin-top: 30px;
            gap: 15px;
        }
        
        .example-item {
            flex: 1;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .example-primary {
            background: var(--color-primary);
            color: white;
        }
        
        .example-secondary {
            background: var(--secondary);
            color: white;
        }
        
        .example-accent {
            background: var(--accent);
            color: #333;
        }
    </style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navInterfazSuperUser.php';
    ?>
    <main class="content">
        <div class="color-form">
            <h2>Configuración de Colores</h2>
            
            <?php if (!empty($message)): ?>
                <div class="message <?= strpos($message, 'Error') === false ? 'success' : 'error' ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <input type="text" name="id" value="<?= $colors['id'] ?? '' ?>" hidden>
                <div class="form-group">
                    <div class="form-row">
                        <span class="color-label">Color Primario:</span>
                        <div class="color-preview" style="background-color: <?= $colors['color_primary'] ?? '#052c53' ?>"></div>
                    </div>
                    <div class="color-input">
                        <input type="color" id="primary" name="primary" value="<?= $colors['color_primary'] ?? '#052c53' ?>">
                        <input type="text" id="primary-text" name="primary-text" value="<?= $colors['color_primary'] ?? '#052c53' ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-row">
                        <span class="color-label">Color de Fondo:</span>
                        <div class="color-preview" style="background-color: <?= $colors['color_background'] ?? '#dddddd' ?>"></div>
                    </div>
                    <div class="color-input">
                        <input type="color" id="background" name="background" value="<?= $colors['color_background'] ?? '#dddddd' ?>">
                        <input type="text" id="background-text" name="background-text" value="<?= $colors['color_background'] ?? '#dddddd' ?>">
                    </div>
                </div>
                
                <button type="submit">Guardar Cambios</button>
            </form>
            
        <!-- <div class="color-example">
                <div class="example-item example-primary">Primario</div>
                <div class="example-item example-secondary">Secundario</div>
                <div class="example-item example-accent">Acento</div>
            </div>-->
        </div>
    </main>
    
    <script>
        // Sincronizar inputs de color y texto
        const colorInputs = document.querySelectorAll('input[type="color"]');
        colorInputs.forEach(input => {
            const textId = input.id + '-text';
            const textInput = document.getElementById(textId);
            
            // Actualizar texto cuando cambia el color
            input.addEventListener('input', () => {
                textInput.value = input.value;
                // Actualizar previsualización
                const preview = input.closest('.form-group').querySelector('.color-preview');
                preview.style.backgroundColor = input.value;
            });
            
            // Actualizar color cuando cambia el texto
            textInput.addEventListener('input', () => {
                if (/^#[0-9A-F]{6}$/i.test(textInput.value)) {
                    input.value = textInput.value;
                    // Actualizar previsualización
                    const preview = input.closest('.form-group').querySelector('.color-preview');
                    preview.style.backgroundColor = textInput.value;
                }
            });
        });
        
        // Actualizar colores de ejemplo cuando cambian los inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                if (input.type === 'color' || (input.type === 'text' && /^#[0-9A-F]{6}$/i.test(input.value))) {
                    document.documentElement.style.setProperty('--primary', document.getElementById('primary').value);
                    document.documentElement.style.setProperty('--secondary', document.getElementById('secondary').value);
                    document.documentElement.style.setProperty('--accent', document.getElementById('accent').value);
                    document.documentElement.style.setProperty('--background', document.getElementById('background').value);
                    document.documentElement.style.setProperty('--text', document.getElementById('text').value);
                }
            });
        });
    </script>

    <?php if (isset($_GET['update']) && $_GET['update'] === 'ok'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Bien!',
                    text: 'Los colores se han actualizado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=gestionInterfaz&metodo=editarInterfazColores";
                    }
                });
            });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['update']) && $_GET['update'] === 'ok'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Bien!',
                    text: 'Los colores se han actualizado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=gestionInterfaz&metodo=editarInterfazColores";
                    }
                });
            });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['update']) && $_GET['update'] === 'error'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Ay jno!',
                    text: 'Ha ocurrido un error al actualizar los colores.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=gestionInterfaz&metodo=editarInterfazColores";
                    }
                });
            });
            </script>
        <?php endif; ?>
</body>
</html>