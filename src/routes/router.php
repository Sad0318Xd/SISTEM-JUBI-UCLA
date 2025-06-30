<?php
class Router {
    public function ejecutar(): void {

        $controlador = $_GET['controlador'] ?? 'inicio';
        $metodo = $_GET['metodo'] ?? 'inicio';

        $controlador = ucfirst($controlador) . 'Controlador';

        $rutaControlador =  __DIR__ . '/../controllers/' . $controlador . '.php';

        if (file_exists($rutaControlador)) {
            require_once $rutaControlador;

            if (class_exists($controlador)) {
                $obj = new $controlador();

                if (method_exists($obj, $metodo)) {
                    $obj->$metodo();
                    return;
                }
            }
        }
        require_once  __DIR__ . '/../views/auth/404error.html';
    }
}

?>