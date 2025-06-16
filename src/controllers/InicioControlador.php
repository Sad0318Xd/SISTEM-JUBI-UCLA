<?php
class InicioControlador {

    public function inicio(): void {
        include_once  __DIR__ . '/../views/inicio.php';
    }

    public function contacto(): void {
        include_once  __DIR__ . '/../views/contacto.php';
    }

    public function interes(): void {
        include_once  __DIR__ . '/../views/interes.php';
    }
}

?>