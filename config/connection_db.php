<?php
// Parámetros de conexión
$host = 'localhost';                    // Dirección del servidor MySQL en tu máquina local
$dbname = 'si_jubi_db';   // Nombre de la base de datos que quieres utilizar
$username = 'root';                     // Usuario de MySQL, en muchos casos "root" en ambientes locales
$password = '';                         // Contraseña, si no tienes definida una, se deja vacía

// Cadena DSN (Data Source Name)
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

try {
    // Crear una nueva instancia de PDO para establecer la conexión
    $pdo = new PDO($dsn, $username, $password);
    
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurar PDO para que devuelva los resultados como arrays asociativos
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Conexión exitosa 
    //echo "Conexión a la base de datos exitosa!";
} catch (PDOException $e) {
    // En caso de error, se muestra el mensaje de error y se detiene la ejecución
    die("Error de conexión: " . $e->getMessage());
}
?>