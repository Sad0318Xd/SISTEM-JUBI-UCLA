<?php
    session_start();

    // Si no existe un usuario autenticado
    if (!isset($_SESSION['ci'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
    } 
    
    include_once __DIR__ . "/../../../config/connection_db.php";

    $sql = "SELECT * FROM interfazadmin WHERE id = 1";
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
    <link rel="stylesheet" href="../src/css/stylegestion2.css">
    <title>Gestión de Solicitudes</title>
    <style>
        :root {
            --color-primary: <?= $colors['color_primary'] ?>;
            --color-background: <?= $colors['color_background'] ?>;
        }
    </style>
</head>
<body>

    <?php
            include __DIR__ . '/../navs/navSolicitudAdmin.php';
    ?>

    <div class="content">
        <h1><?=$texto['titulo_soli_gestion']?></h1>
        <p><?= $texto['texto_soli_gestion1']?></p>
        <p><?= $texto['texto_soli_gestion2']?></p>
    </div>
</body>
</html>