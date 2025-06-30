<?php

    // Si no existe un usuario autenticado, mostrar su nombre y rol
    if (!isset($_SESSION['ci'])) {
        header("Location: index.php?controlador=autenticacion&metodo=login");
    }
        
    $fecha_actual = new DateTime();
    $fecha_ingreso = new DateTime($_SESSION['fecha_ingreso']);
    $añosServicio = $fecha_actual->diff($fecha_ingreso);

    include_once __DIR__ . "/../../../config/connection_db.php";
    $id = 1;
    $sql = "SELECT * FROM interfazempleado WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $texto = $stmt->fetch();
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
    <title>Solicitar Jubilación</title>
<style>

        form { max-width: 500px; margin: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espacio entre columnas */
            justify-content: space-between; 
        }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; }
        input[type="submit"] { margin-top: 15px; padding: 10px; width: 100%; }
        .error { color: red; text-align: center; }

        .formulario {
            display: flex;
            flex-wrap: wrap;
            gap: 100px; /* Espacio entre columnas */
            justify-content: space-between;
        }

        .columna {
            display: flex;
            flex-direction: column;
            width: 45%; /* Ajusta el ancho de cada columna */
        }
    </style>
</head>
<body>

    <?php
        include __DIR__ . '/../navs/navSolicitarJubiEmpleado.php';
    ?>

    <div class="content">

        <h1 style="margin-top: 30px;"><?= $texto['titulo_soli']?></h1>
        <p><?= $texto['texto_soli']?></p>

        <form action="?controlador=solicitud&metodo=solicitud" method="post">
            <div class="columna">    
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" required value="<?= $_SESSION['ci']?> " readonly>
                
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required value="<?= $_SESSION['name']?>" readonly>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required value="<?= $_SESSION['lastname']?>" readonly>

                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" required value="<?= $_SESSION['cargo']?>" readonly>
            </div>

            <div class="columna">

                <label for="departamento">Departamento:</label>
                <input type="text" id="departamento" name="departamento" required value="<?= $_SESSION['departamento']?>" readonly>

                <label for="añosServicio">Años de servicio:</label>
                <input type="text" id="añosServicio" name="añosServicio" required value="<?= $añosServicio->y ?>" readonly>
                
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required value="<?= $_SESSION['edad']?>" readonly>
                
                <label for="tipoJubilacion">Tipo de jubilacion:</label>
                <input type="text" id="tipoJubilacion" name="tipoJubilacion" required value="">
            </div>
        
        <input type="submit" value="Enviar solicitud">
    </form>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'existe'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: 'Ya has enviado una solicitud de jubilación antes.',
                    icon: 'error',
                    confirmButtonText: 'Ver estado',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=solicitud&metodo=solicitud";
                    }
                });
            });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['exito']) && $_GET['exito'] === '1'): ?>
            <script>
                    document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Listo!',
                        text: 'Solicitud enviada correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Ver estado y descargar carta',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("index.php?controlador=procesarSolicitud&metodo=GenerarPDF&id=<?= $_SESSION['ci'] ?>", "_blank");
                            window.location.href = "index.php?controlador=gestionSolicitud&metodo=estadoVistaEmpleado";
                        }
                    });
                });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalido'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: 'No cumples con los requisitos para iniciar con tu proceso de jubilación. Verifica que CUMPLES con los AÑOS de servicio o la EDAD correspondiente.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?controlador=solicitud&metodo=solicitud";
                    }
                });
            });
            </script>
        <?php endif; ?>
      
</body>
</html>