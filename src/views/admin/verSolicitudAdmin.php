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
    <link rel="stylesheet" href="../src/css/stylegestion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Solicitudes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Chocolate Classical Sans', sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Contenido principal */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 30px;
            margin-top: 30px;
        }
        
        .page-title {
            text-align: center;
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3498db;
        }
        
        /* Panel de información a la derecha */
        .info-panel {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            height: fit-content;
        }
        
        .panel-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .total-solicitudes {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #1a73e8;
        }
        
        .filter-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-group label {
            font-weight: bold;
            color: #2c3e50;
        }
        
        .form-group input,
        .form-group select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .btn-submit {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
        }
        
        .btn-submit:hover {
            background: #1a2a4a;
        }
        
        /* Tabla de solicitudes */
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow-x: auto;
            max-height: 700px;      
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background-color: #f8f9fa;
            color:rgb(255, 255, 255);
            font-weight: bold;
            background: #052c53;
        }
        
        tr:hover {
            background-color: #f5f7fa;
        }     
        
        
        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .info-panel {
                order: -1;
                margin-bottom: 30px;
            }
        }

                

    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <?php
            include __DIR__ . '/../navs/navSolicitudAdmin.php';
    ?>

    <div class="container">
        <h1 class="page-title">Solicitudes de Jubilación</h1>
        
        <div class="main-content">
            <!-- Contenido principal con la tabla -->
            <div class="table-container">
                <div class="table-header">
                    <h2>Listado de Solicitudes</h2>
                </div>
                
                <!-- Contenedor para el scroll -->
                <div style="max-height: auto; overflow-y: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del solicitante</th>
                                <th>Cédula</th>
                                <th>Asunto</th>
                                <th>Estado</th>
                                <th>Recibo en</th>
                                <th>Acción</th>
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
                                        <a href="?controlador=procesarSolicitud&metodo=rechazarSolicitud&ci=<?= $soli['empleado_solicitud'] ?>" class="btn-rechazar">Rechazar</a>
                                    <?php elseif ($soli['estado'] == 'Aprobado'): ?>
                                        <span class="badge-success">Aprobado</span>
                                    <?php elseif ($soli['estado'] == 'Rechazada'): ?>
                                        <span class="badge-error">Rechazada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button onclick="window.location.href='index.php?controlador=VerSolicitud&metodo=VerSolicitud&confirmar=ok&ci=<?= $soli['empleado_solicitud'] ?>'" class="delete-btn" >Eliminar</button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Panel de información a la derecha -->
            <div class="info-panel">
                <h3 class="panel-title">Filtros y Estadísticas</h3>
                
                <div class="total-solicitudes">
                    Total de solicitudes: <?= $total_solicitudes ?? '0' ?>
                </div>
                
                <form class="filter-form" method="GET" action="">
                    <input type="hidden" name="controlador" value="<?= $_GET['controlador'] ?? '' ?>">
                    <input type="hidden" name="metodo" value="<?= $_GET['metodo'] ?? '' ?>">
                    
                    <div class="form-group">
                        <label for="ciFilter">Buscar por CI:</label>
                        <input type="text" id="ciFilter" name="ciFilter" placeholder="Ingrese cédula..." value="<?= $ci_filter ?>">
                    </div>
                    <button type="submit" class="btn-submit">Aplicar Filtros</button>
                </form>
                <form class="filter-form" method="GET" action="">
                    
                    <div class="form-group">
                        <label for="estado">Filtrar por estado:</label>
                        <input type="hidden" name="controlador" value="<?= $_GET['controlador'] ?? '' ?>">
                        <input type="hidden" name="metodo" value="<?= $_GET['metodo'] ?? '' ?>">
                        <select id="estado" name="estado">
                            <option value="">Todos los estados</option>
                            <option value="Pendiente" <?= ($estado_filtro == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                            <option value="En proceso" <?= ($estado_filtro == 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                            <option value="Aprobado" <?= ($estado_filtro == 'Aprobado') ? 'selected' : '' ?>>Aprobado</option>
                            <option value="Rechazada" <?= ($estado_filtro == 'Rechazada') ? 'selected' : '' ?>>Rechazada</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn-submit">Aplicar Filtros</button>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['procesado']) && $_GET['procesado'] === 'ok'): ?>
        <script>
            Swal.fire({
                title: '¡Listo!',
                text: 'Solicitud procesada correctamente.',
                icon: 'success',
                confirmButtonText: 'Ver carta en PDF'
            }).then(() => {
                window.open("index.php?controlador=procesarSolicitud&metodo=GenerarPDF&id=<?= $_GET['id'] ?>", "_blank");
                window.location.href = "index.php?controlador=VerSolicitud&metodo=VerSolicitud";
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['aprobado']) && $_GET['aprobado'] === 'ok'): ?>
        <script>
            Swal.fire({
                title: '¡Listo!',
                text: 'Solicitud aprobada correctamente.',
                icon: 'success',
                confirmButtonText: 'Ver aprobación en PDF'
            }).then(() => {
                window.open("index.php?controlador=procesarSolicitud&metodo=generarAprobacionPDF&id=<?= $_GET['id'] ?>", "_blank");
                window.location.href = "index.php?controlador=VerSolicitud&metodo=VerSolicitud";
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['rechazada']) && $_GET['rechazada'] === 'ok'): ?>
        <script>
            Swal.fire({
                title: '¡Listo!',
                text: 'Solicitud rechazada correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = "index.php?controlador=VerSolicitud&metodo=VerSolicitud";
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['confirmar']) && $_GET['confirmar'] === 'ok'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la solicitud seleccionada.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=procesarSolicitud&metodo=EliminarSolicitud&ci=<?= $_GET['ci'] ?>";
                    }
                });
            });
        </script>
    <?php endif; ?>
</body>
</html>