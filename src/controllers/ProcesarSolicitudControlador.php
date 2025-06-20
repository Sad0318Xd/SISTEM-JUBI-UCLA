<?php
class ProcesarSolicitudControlador {

    public function ProcesarSolicitud(): void {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['ci'])) {
                
                $ci = $_GET['ci'];
                include_once __DIR__ . '/../../config/connection_db.php';
                include_once __DIR__ . '/../models/Solicitud.php';

                $solicitud = new Solicitud($pdo);

                $solicitud->ChangesStatus($ci, 'En proceso');

                header("Location: index.php?controlador=VerSolicitud&metodo=VerSolicitud&procesado=ok&id=$ci");

                } else {
                    echo "No se ha encontrado una solicitud para el CI proporcionado.";
                }

            } else {
                echo "No se ha proporcionado un ID de solicitud.";
            }

        }

        public function AprobarSolicitud(): void {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['ci'])) {
                
                $ci = $_GET['ci'];
                include_once __DIR__ . '/../../config/connection_db.php';
                include_once __DIR__ . '/../models/Solicitud.php';

                $solicitud = new Solicitud($pdo);

                $solicitud->ChangesStatus($ci, 'Aprobado');

                header("Location: index.php?controlador=VerSolicitud&metodo=VerSolicitud&aprobado=ok&id=$ci");

                } else {
                    echo "No se ha encontrado una solicitud para el CI proporcionado.";
                }

            } else {
                echo "No se ha proporcionado un ID de solicitud.";
            }

        } 
    
    public function GenerarPDF() {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ci = $_GET['id'] ?? null;
            include_once __DIR__ . '/../../config/connection_db.php';
            include_once __DIR__ . '/../models/Usuario.php';
            include_once __DIR__ . '/../models/Solicitud.php';

            $datauser = new Usuario($pdo);
            $datauser = $datauser->findByCI($ci);

                if ($datauser) {
                    $name = $datauser->name;
                    $lastname = $datauser->lastname;
                    $departamento = $datauser->departamento;
                    $telefono = $datauser->telefono;
                    $cargo = $datauser->cargo;
                } else {
                    echo "Usuario no encontrado.";
                }

                $solicitud = new Solicitud($pdo);
                $solicitudData = $solicitud->FindSolicByCI($ci)->fetch();

                if ($solicitudData) {
                    $estado = $solicitudData['estado'];
                    $fecha_creacion = $solicitudData['fecha_creacion'];

                    $fecha = new DateTime($fecha_creacion);
                    $meses = [
                        '01' => 'enero', '02' => 'febrero', '03' => 'marzo',
                        '04' => 'abril', '05' => 'mayo', '06' => 'junio',
                        '07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
                        '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
                    ];

                    $dia = $fecha->format('d');
                    $mes = $meses[$fecha->format('m')];
                    $ano = $fecha->format('Y');
                    
                    include_once __DIR__ . '/../report/reporte.php';
            }
        }
    }

    public function GenerarAprobacionPDF() {

        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ci = $_GET['id'] ?? null;
            include_once __DIR__ . '/../../config/connection_db.php';
            include_once __DIR__ . '/../models/Usuario.php';
            include_once __DIR__ . '/../models/Solicitud.php';

            $datauser = new Usuario($pdo);
            $datauser = $datauser->findByCI($ci);

                if ($datauser) {
                    $name = $datauser->name;
                    $lastname = $datauser->lastname;
                    $departamento = $datauser->departamento;
                    $cargo = $datauser->cargo;
                } else {
                    echo "Usuario no encontrado.";
                }

                $solicitud = new Solicitud($pdo);
                $solicitudData = $solicitud->FindSolicByCI($ci)->fetch();

                if ($solicitudData) {
                    $fecha_completa = $solicitudData['fecha_actualizacion'];
                    $fecha_modi = date("Y-m-d", strtotime($fecha_completa));

                    // O usando DateTime:
                    $fecha_obj = new DateTime($fecha_completa);
                    $fecha_modi = $fecha_obj->format('Y-m-d');

                    //$fecha_creacion = $solicitudData['fecha_creacion'];

                    /*$fecha = new DateTime($fecha_creacion);
                    $meses = [
                        '01' => 'enero', '02' => 'febrero', '03' => 'marzo',
                        '04' => 'abril', '05' => 'mayo', '06' => 'junio',
                        '07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
                        '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
                    ];

                    $dia = $fecha->format('d');
                    $mes = $meses[$fecha->format('m')];
                    $ano = $fecha->format('Y');*/

                    $fecha_aprobacion = new DateTime($fecha_modi);
                    $fecha_ingreso = new DateTime($_SESSION['fecha_ingreso']);
                    $añosServicio = $fecha_aprobacion->diff($fecha_ingreso);
                    
                    include_once __DIR__ . '/../report/reporteAprob.php';
                }
            }
        }
    }
?>