<?php
class SolicitudControlador {

    public function solicitud(): void {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once __DIR__ . '/../../config/connection_db.php';
            require_once __DIR__ . "/../models/Solicitud.php"; 

            $solicitud = new Solicitud($pdo);
            
            $exits = $solicitud->FindSolicByCI($_SESSION['ci'])->fetch();
            
            if($exits)
            {
                header("Location: index.php?controlador=solicitud&metodo=solicitud&error=existe");
                return;
            }
            
            $nameInput = $_POST['nombre']  . ' ' . $_POST['apellido'] ?? '';
            $añosServicioInput = $_POST['añosServicio'] ?? '';
            $estado = "Pendiente";

            if ($añosServicioInput >= 25) {
                $asuntoInput = "Me quiero jubilar porque ya cumplí con los años de servicio.";
            } elseif ($_POST['edad'] >= 60) {
                $asuntoInput = "Me quiero jubilar porque ya cumplí con la edad.";
            }
            

            $solicitud->name = $nameInput;
            $solicitud->asunto = $asuntoInput;
            $solicitud->estado = $estado;
            $solicitud->empleado_solicitud_id = $_SESSION['ci'];
            $solicitud->EnviarSolicitud();

            header("Location: index.php?controlador=solicitud&metodo=solicitud&exito=1");
            
        } else {

           include_once  __DIR__ . '/../views/empleado/solicitarJubiEmpleado.php';
           
        }

    }
}

?>