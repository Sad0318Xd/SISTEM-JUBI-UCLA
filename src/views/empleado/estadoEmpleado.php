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
</style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navSolicitarJubiEmpleado.php';
    ?>

    <div class="content">
        <h1>Bienvenido al apartado para consultar tu estado</h1>
        <p>Aquí va el contenido principal...</p>
    </div>
    <?php
            session_start();
            // Si no existe un usuario autenticado, mostrar su nombre y rol
            if (!isset($_SESSION['ci'])) {
                header("Location: index.php?controlador=autenticacion&metodo=login");
            } else {

            }
            ?>

</body>
</html>