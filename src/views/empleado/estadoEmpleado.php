<?php
        session_start();
        
        require_once __DIR__ . '/../../../config/connection_db.php';
        // Si no existe un usuario autenticado, mostrar su nombre y rol
        if (!isset($_SESSION['ci'])) {
            header("Location: index.php?controlador=autenticacion&metodo=login");
        } 

        $sql = "SELECT * FROM solicitudes WHERE empleado_solicitud = '$_SESSION[ci]'";
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
    <link rel="stylesheet" href="../src/css/stylejubiempleado.css">
    <title>Estado de la Solicitud</title>
    <style>
        .table {
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
            background-color: #052c53;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }

    </style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navSolicitarJubiEmpleado.php';
    ?>

    <main class="content">
        <h1>Bienvenido al apartado para consultar tu estado</h1>
        <p>Aquí se muestra el estado en el que se encuentra tu solicitud de jubilación, <?= $_SESSION['name'] . ' ' . $_SESSION['lastname']?> </p>
            <div class="contenedor-estado">
                <div class="estado">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Asunto</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($userData = $stmt->fetch()): ?>

                            <tr>
                                <th><?= $userData['name']?></th>
                                <th><?= $userData['asunto']?></th>
                                <th><?= $userData['estado']?></th>
                            </tr>
                            <?php endwhile; ?>



                        </tbody>
                    </table>
                </div>  
            </div>
    </main>
    

</body>
</html>