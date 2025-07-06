<?php
        session_start();
        
        require_once __DIR__ . '/../../../config/connection_db.php';
        // Si no existe un usuario autenticado, mostrar su nombre y rol
        if (!isset($_SESSION['ci'])) {
            header("Location: index.php?controlador=autenticacion&metodo=login");
        } 

        $sql = "SELECT * FROM solicitudes WHERE empleado_solicitud = :ci";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ci', $_SESSION['ci'], PDO::PARAM_STR);
        $stmt->execute();

        $solidata = $stmt->fetch();

        $sql = "SELECT * FROM interfazempleado WHERE id = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $texto = $stmt->fetch();

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
    <link rel="stylesheet" href="../src/css/stylegestion1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Estado de la Solicitud</title>
    <style>
        :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
    </style>
</head>

<body>

    <?php
        include __DIR__ . '/../navs/navSolicitarJubiEmpleado.php';
    ?>

    <main class="content">

        <h1><?= $texto['titulo_consultar']?></h1>
        <p style="margin: 20px; margin-bottom: 30px;"><?= $texto['texto_consultar1']?> <?=$_SESSION['name'] . ' ' . $_SESSION['lastname']?> </p>

            <div class="contenedor-estado">
                
                <div class="estado">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Asunto</th>
                                <th>Estado</th>
                                <th>Dia Actualizado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if ($solidata): ?>
                            <tr>
                                <th><?= $solidata['name']?></th>
                                <th><?= $solidata['asunto']?></th>
                                <th><?= $solidata['estado']?></th>
                                <th><?= $solidata['fecha_actualizacion']?></th>
                            </tr>
                            <?php else: ?>
                                <tr><td colspan="3">No hay solicitud registrada aún.</td></tr>
                            <?php endif; ?>

                        </tbody>
                    </table>

                    
                </div>  
            </div>
    </main>
    
    <?php if ($solidata && $solidata['estado'] === 'Aprobado'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Tu solicitud ha sido aprobada!',
                    text: 'Puedes descargar el pdf para ver la carta de aprobación de tu solicitud.',
                    icon: 'success',
                    confirmButtonText: 'Ver PDF',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open("index.php?controlador=procesarSolicitud&metodo=GenerarAprobacionPDF&id=<?= $_SESSION['ci'] ?>", "_blank");
                    }
                    // No redirijas inmediatamente, deja que el usuario decida
                });
            });
        </script>
    <?php endif; ?>

</body>
</html>