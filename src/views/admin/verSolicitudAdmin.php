<?php
        session_start();
        require_once __DIR__ . '/../../../config/connection_db.php';
        require_once __DIR__ . '/../../models/Solicitud.php';

        // Si no existe un usuario autenticado
        if (!isset($_SESSION['ci'])) {
            header("Location: index.php?controlador=autenticacion&metodo=login");
        }

        // Obtener el estado del filtro si existe
        $estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';

        $ci_filter = isset($_GET['ciFilter']) ? $_GET['ciFilter'] : '';

        $solicitud = new Solicitud($pdo);
        
        if($ci_filter){
            $solicitudes = $solicitud->FindSolicByCI($ci_filter);
            $total_solicitudes = $solicitud->TotalSolicitudesByCI($ci_filter);
        }else{
            $solicitudes = $solicitud->FindSolicByStatus($estado_filtro);
            $total_solicitudes = $solicitud->TotalSolicitudes($estado_filtro);
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
    <link rel="stylesheet" href="../src/css/stylegestion1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Solicitudes</title>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navSolicitudAdmin.php';
    ?>

    <div class="content">
        <h1>Solicitudes de Jubilación</h1>

        <div class="info-bar">
            <div class="total-solicitudes">Total de solicitudes: <?= $total_solicitudes ?? '0' ?></div>

            <form method="GET" action="">
                <input type="hidden" name="controlador" value="<?= $_GET['controlador'] ?? '' ?>">
                <input type="hidden" name="metodo" value="<?= $_GET['metodo'] ?? '' ?>">
                <input type="text" name="ciFilter" placeholder="Buscar solicitud por CI..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; width: 250px;">
                <button type="submit" style="background: #2c3e50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Buscar</button>
            </form>

            <form method="GET" action="">
                <input type="hidden" name="controlador" value="<?= $_GET['controlador'] ?? '' ?>">
                <input type="hidden" name="metodo" value="<?= $_GET['metodo'] ?? '' ?>">

                <select name="estado" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; width: 250px;">
                    <option value="">Todos los estados</option>
                    <option value="Pendiente" <?= ($estado_filtro == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                    <option value="En proceso" <?= ($estado_filtro == 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                    <option value="Aprobado" <?= ($estado_filtro == 'Aprobado') ? 'selected' : '' ?>>Aprobado</option>
                    <option value="Rechazado" <?= ($estado_filtro == 'Rechazado') ? 'selected' : '' ?>>Rechazado</option>
                </select>
                <button type="submit" style="background: #2c3e50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Filtrar</button>
            </form>
        </div>

        <!-- Contenedor para el scroll -->
        <div class="tabla-container">

            <table class="">
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del solicitante</th>
                        <th>Cédula</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Recibo en</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($soli = $solicitudes->fetch()): ?>

                    <tr>

                        <td><?= $soli['id']?></td>
                        <td><?= $soli['name']?></td>
                        <td><?= $soli['empleado_solicitud']?></td>
                        <td><?= $soli['asunto']?></td>
                        <td><?= $soli['estado']?></td>
                        <td><?= $soli['fecha_creacion']?></td>

                        <td>
                            <?php if ($soli['estado'] == 'Pendiente'): ?>
                                <a href="?controlador=procesarSolicitud&metodo=procesarSolicitud&ci=<?= $soli['empleado_solicitud'] ?>" class="btn-procesar">Procesar</a>
                            <?php elseif ($soli['estado'] === 'En proceso'): ?>
                                <a href="?controlador=procesarSolicitud&metodo=aprobarSolicitud&ci=<?= $soli['empleado_solicitud'] ?>" class="btn-aprobar">Aprobar</a>
                            <?php elseif ($soli['estado'] == 'Aprobado'): ?>
                                <span class="badge-success">✓   Aprobado</span>
                            <?php elseif ($soli['estado'] == 'Rechazado'): ?>
                                <span class="badge-error">✗  Rechazado</span>
                            <?php endif; ?>
                        </td>
                        <td><a href="deleteTask.php?id=<?= $soli['id']?>">Eliminar</a></td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>
            </table>

        </div>
    </div>

    <?php if (isset($_GET['procesado']) && $_GET['procesado'] === 'ok'): ?>
        <script>
            Swal.fire({
                title: '¡Listo!',
                text: 'Solicitud procesada correctamente.',
                icon: 'success',
                confirmButtonText: 'Ver PDF'
            }).then(() => {
                // Abrir el PDF generado en una nueva pestaña
                window.open("index.php?controlador=procesarSolicitud&metodo=GenerarPDF&id=<?= $_GET['id'] ?>", "_blank");
                // Recarga la URL para evitar repetir el mensaje
                window.location.href = "index.php?controlador=VerSolicitud&metodo=VerSolicitud";
            });
        </script>
        <?php endif; ?>
    
</body>
</html>