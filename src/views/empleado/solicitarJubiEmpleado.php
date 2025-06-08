<?php
            
        // Si no existe un usuario autenticado, mostrar su nombre y rol
        if (!isset($_SESSION['ci'])) {
            header("Location: index.php?controlador=autenticacion&metodo=login");
        } else {
            // Si no hay usuario autenticado, mostrar el enlace de login
                
            //echo "Usuario: " . $_SESSION['name'] . " (" . $_SESSION['rol'] . ") | ";
            // Mostrar un enlace para cerrar sesión
            //echo '<a href="?controlador=autenticacion&metodo=logout">Cerrar Sesión</a>';
        }
            
        $fecha_actual = new DateTime();
        $fecha_ingreso = new DateTime($_SESSION['fecha_ingreso']);
        $añosServicio = $fecha_actual->diff($fecha_ingreso);
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
    <title>Solicitar Jubilación</title>
<style>

        form { max-width: 300px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; }
        input[type="submit"] { margin-top: 15px; padding: 10px; width: 100%; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navSolicitarJubiEmpleado.php';
    ?>

    <div class="content">
        <h1>Bienvenido al apartado donde podrás solicitar tu jubilación</h1>
        <p>Aquí va el contenido principal...</p>

        <form action="?controlador=solicitud&metodo=solicitud" method="post">
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required value="<?= $_SESSION['ci']?> " readonly>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required value="<?= $_SESSION['name']?>">

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required value="<?= $_SESSION['lastname']?>">

        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required value="<?= $_SESSION['rol']?>">

        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" required value="<?= $_SESSION['departamento']?>">

        <label for="añosServicio">Años de servicio:</label>
        <input type="text" id="añosServicio" name="añosServicio" required value="<?= $añosServicio->y ?>" readonly>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required value="<?= $_SESSION['edad']?>" readonly>
        
        <label for="tipoJubilacion">Tipo de jubilacion:</label>
        <input type="text" id="tipoJubilacion" name="tipoJubilacion" required value="">
        
        <input type="submit" value="Enviar solicitud">
    </form>
    </div>
    

    
</body>
</html>