<?php
class SolicitudControlador {

    public function solicitud(): void {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once __DIR__ . '/../../config/connection_db.php';
            require_once __DIR__ . "/../models/Solicitud.php"; 
            
            $nameInput = $_POST['nombre'] ?? '';
            $añosServicioInput = $_POST['añosServicio'] ?? '';
            $estado = "Pendiente";

            if ($añosServicioInput >= 25) {
                $asuntoInput = "Me quiero jubilar porque ya cumpli con los años de servicio";
            } else {
                $asuntoInput = "Me quiero jubilar porque NI IDEA";
            }
            $solicitud = new Solicitud($pdo);

            $solicitud->name = $nameInput;
            $solicitud->asunto = $asuntoInput;
            $solicitud->estado = $estado;
            $solicitud->empleado_solicitud_id = $_SESSION['ci'];
            $solicitud->EnviarSolicitud();
            
        } else {

           include_once  __DIR__ . '/../views/empleado/solicitarJubiEmpleado.php';
           
        }

    }
}

?>