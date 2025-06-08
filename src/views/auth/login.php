<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/stylelogin.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../src/img/logoucla.png" alt="Logo">
            <h1>JUBILACIÓN UCLA</h1>

            <a href="">ATRÁS</a>
        </div>
    </header>
    
    <div class="login-container">

        <!-- Título de la página de inicio de sesión -->
        <h1>Iniciar Sesión</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- El formulario se envía al enrutador pasando controlador 'autenticacion' y método 'login' -->
        <form action="?controlador=autenticacion&metodo=login" method="post">

            <label for="usuario">Usuario:</label>
            <input class="inputs" type="text" id="usuario" name="usuario" required>
            
            <label for="password">Contraseña:</label>
            <input class="inputs" type="password" id="password" name="password" required>
            
            <input type="submit" value="Ingresar">

        </form>

    </div>

    <footer>
        &copy; 2025 Universidad Centroccidental Lisandro Alvarado. Todos los derechos reservados.
    </footer>
</body>
</html>