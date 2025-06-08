<?php
class VerSolicitudControlador {

    public function VerSolicitud(): void {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        } else { 
            include_once  __DIR__ . '/../views/admin/verSolicitudAdmin.php';
        } 
    }
}
?>