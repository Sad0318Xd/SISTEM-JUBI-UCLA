<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin: 15px 0;
        }

        .menu li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .menu li a:hover {
            background-color: #f39c12;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }
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
            background-color: #34495E;
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

    <div class="sidebar">
        <h2>Menú</h2>
        <ul class="menu">
            <li><a href="?controlador=VerSolicitud&metodo=VerSolicitud">Solicitudes</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Configuración</a></li>
            <li><a href="?controlador=inicio&metodo=inicio">Salir</a></li>
        </ul>
    </div>

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

    <div class="content">
        <h1>Solicitudes Recientes</h1>
    </div>
    

    <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Asunto</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($userData = $stmt->fetch()): ?>

                <tr>

                    <th><?= $userData['id']?></th>
                    <th><?= $userData['name']?></th>
                    <th><?= $userData['asunto']?></th>

                    <th><a href="updateTask.php?id=<?= $userData['id']?>">Editar</a></th>
                    <th><a href="deleteTask.php?id=<?= $userData['id']?>">Eliminar</a></th>

                </tr>
                <?php endwhile; ?>



            </tbody>
        </table>

    
</body>
</html>