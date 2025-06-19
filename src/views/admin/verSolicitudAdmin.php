<?php
        session_start();
        require_once __DIR__ . '/../../../config/connection_db.php';
        // Si no existe un usuario autenticado, mostrar su nombre y rol
        if (!isset($_SESSION['ci'])) {
            header("Location: index.php?controlador=autenticacion&metodo=login");
        } 

        $sql = "SELECT * FROM solicitudes";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

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
        /*.table {
        border-collapse: separate;
        width: 100%;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
        border-radius: 8px;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            
            border-radius: 2px;
        }

        .table th {
            background-color: #34495E;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }*/
        .contenedor-con-scroll {
    max-height: 400px;       /* Altura máxima antes de aparecer scroll */
    overflow-y: auto;        /* Scroll vertical automático */
    border: 1px solid #ddd;  /* Borde opcional */
    border-radius: 4px;      /* Bordes redondeados opcionales */
    padding: 10px;           /* Espaciado interno */
}

        .tabla-contenedor {
    max-height: 300px;
    overflow-y: auto;
    position: relative;
    border: 1px solid #ccc;
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    position: sticky; /* Mantiene los encabezados visibles */
    top: 0;
    background: white;
    box-shadow: 0 2px 2px -1px rgba(0,0,0,0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

tbody tr:hover {
    background-color: #f5f5f5;
}

.tabla-contenedor::-webkit-scrollbar {
    width: 10px; /* Ancho del scroll */
}

.tabla-contenedor::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color del fondo */
}

.tabla-contenedor::-webkit-scrollbar-thumb {
    background: #888; /* Color de la barra */
    border-radius: 5px;
}

.tabla-contenedor::-webkit-scrollbar-thumb:hover {
    background: #555; /* Color al pasar el mouse */
}



        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3498db;
        }

        .tabla-container {
            max-height: 610px;
            overflow-y: auto;
            border: 1px solid #e1e5eb;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            width: 100%;
        }

        table {
            width: 100%;
            min-width: 800px;
        }

        thead {
            position: sticky;
            top: 0;
            background: #2c3e50;
            color: white;
            z-index: 10;
        }

        th {
            padding: 16px 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #edf2f7;
            transition: background-color 0.2s;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fc;
        }

        tbody tr:hover {
            background-color: #e3f2fd;
        }

        td {
            padding: 14px 15px;
            color: #4a5568;
        }

        .action-links {
            display: flex;
            gap: 10px;
        }

        .action-links a {
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
        }

        .edit-btn {
            background-color: #3498db;
            color: white;
            border: 1px solid #2980b9;
        }

        .edit-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: 1px solid #c0392b;
        }

        .delete-btn:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Personalización del scrollbar */
        .tabla-container::-webkit-scrollbar {
            width: 10px;
        }

        .tabla-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 0 8px 8px 0;
        }

        .tabla-container::-webkit-scrollbar-thumb {
            background: #b8c2cc;
            border-radius: 5px;
        }

        .tabla-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .info-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 12px 15px;
            background: #e3f2fd;
            border-radius: 6px;
            border-left: 4px solid #3498db;
            flex-direction: column;
        }

        .total-solicitudes {
            font-weight: 600;
            color: #2c3e50;
        }

    </style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navSolicitudAdmin.php';
    ?>

    <div class="content">
        <h1>Solicitudes de Jubilación</h1>

        <div class="info-bar">
            <div class="total-solicitudes">Total de solicitudes: 8</div>
            <div>
                <input type="text" placeholder="Buscar solicitud..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; width: 250px;">
                <button style="background: #2c3e50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Buscar</button>
            </div>
            <div>
                <select style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; width: 250px;"> 
                    <option value=""></option>
                    <option value="">Pendiente</option>
                    <option value="">En proceso</option>
                    <option value="">Aprobado</option>
                    <option value="">Rechazado</option>
                </select>
                <button style="background: #2c3e50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Buscar</button>
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
                    <?php while($solicitud = $stmt->fetch()): ?>

                    <tr>

                        <td><?= $solicitud['id']?></td>
                        <td><?= $solicitud['name']?></td>
                        <td><?= $solicitud['empleado_solicitud']?></td>
                        <td><?= $solicitud['asunto']?></td>
                        <td><?= $solicitud['estado']?></td>
                        <td><?= $solicitud['fecha_creacion']?></td>

                        <td><?php if ($solicitud['estado'] == 'Pendiente'): ?>
                        <a href="?controlador=procesarSolicitud&metodo=procesarSolicitud&ci=<?=$solicitud['empleado_solicitud']?>" class="btn-procesar">Procesar</a>
                        <?php else: ?>
                        <button disabled>Procesado</button>
                        <?php endif; ?></td>
                        <td><a href="deleteTask.php?id=<?= $solicitud['id']?>">Eliminar</a></td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>
            </table>

        </div>
    </div>
    
</body>
</html>