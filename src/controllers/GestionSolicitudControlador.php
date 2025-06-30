<?php
class GestionSolicitudControlador {

    public function GestionVistaAdmin(): void {
        include_once  __DIR__ . '/../views/admin/gestionSolicitudAdmin.php';
    }

    public function VerSolicitudVistaAdmin(): void {
        
        include_once  __DIR__ . '/../views/admin/verSolicitudAdmin.php';

    }

    public function EstadoVistaEmpleado(): void {
        include_once  __DIR__ . '/../views/empleado/estadoEmpleado.php';
    }

    public function InicioVistaEmpleado(): void {
        include_once  __DIR__ . '/../views/empleado/jubilacionEmpleado.php';
    } 
}
?>