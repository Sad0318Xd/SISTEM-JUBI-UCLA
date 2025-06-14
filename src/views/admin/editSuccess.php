<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/stylecursos.css">
    <link rel="stylesheet" href="../src/css/stylejubiempleado.css">
    <title>Inicio</title>
</head>
<body>
    <?php
        include __DIR__ . '/../navs/navCursosAdmin.php';
    ?>
    <main class="content">
 
        <h1>Cursos editado <span class="highlight">Exitósamente</span></h1>
        <p>El curso ha sido actualizado en la base de datos correctamente.</p>

    </main>

</body>
</html>