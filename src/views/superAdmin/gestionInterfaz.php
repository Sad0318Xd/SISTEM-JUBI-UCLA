<?php
    session_start();
    // Si no existe un usuario autenticado, mostrar su nombre y rol
    if (!isset($_SESSION['rol'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
    }

    include_once __DIR__ . "/../../../config/connection_db.php";

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
    <link rel="stylesheet" href="../src/css/stylegestion2.css">
    <title>Jubilación para Empleados</title>
</head>
<style>
    :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
</style>
<body>

    <?php
        include __DIR__ . '/../navs/navInterfazSuperUser.php';
    ?>

    <main class="content">
        <h1>Un gusto tenerlo de vuelta SuperUsuario</h1>
        <p>¿Qué editarás hoy?</p>
        <p></p>
    </main>
    
</body>
</html>