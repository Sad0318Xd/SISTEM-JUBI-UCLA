<?php
class GestionInterfazControlador {

    public function GestionVistaUser(): void {
        include_once  __DIR__ . '/../views/superAdmin/gestionInterfaz.php';
    }

    public function EditarInterfazAdmin(): void {
        include_once  __DIR__ . '/../views/superAdmin/editarInterfazAdmin.php';
    }
    public function EditarInterfazEmpleado(): void {
        include_once  __DIR__ . '/../views/superAdmin/editarInterfazEmpleado.php';
    }

    public function ActualizarInterfazAdmin() {
        
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = (int) $_POST['id'];
            $texto_inicio = trim($_POST['texto_inicio']);
            $titulo_inicio_solicitudes = trim($_POST['titulo_inicio_solicitudes']);
            $texto_inicio_solicitudes = trim($_POST['texto_inicio_solicitudes']);
            $texto2_inicio_solicitudes = trim($_POST['texto2_inicio_solicitudes']);
            $titulo_listado_solicitudes = trim($_POST['titulo_listado_solicitudes']);
            $titulo_gestion_cursos = trim($_POST['titulo_gestion_cursos']);
            $texto_inicio_cursos = trim($_POST['texto_inicio_cursos']);
            $texto2_inicio_cursos = trim($_POST['texto2_inicio_cursos']);

            require_once __DIR__ . '/../../config/connection_db.php';
            require_once __DIR__ . '/../models/InterfazAdmin.php';

            $interfaz = new InterfazAdmin($pdo);

            // 2) Preparar UPDATE dinámico
            $campos = [
                'texto_inicio'      => $texto_inicio,
                'titulo_soli_gestion' => $titulo_inicio_solicitudes,
                'texto_soli_gestion1'  => $texto_inicio_solicitudes,
                'texto_soli_gestion2'       => $texto2_inicio_solicitudes,
                'titulo_lista_soli'       => $titulo_listado_solicitudes,
                'titulo_curso_gestion'       => $titulo_gestion_cursos,
                'texto_curso_gestion1'       => $texto_inicio_cursos,
                'texto_curso_gestion2'       => $texto2_inicio_cursos
            ];


            // Montar SET clausula
            $setParts = [];
            $vals     = [];

            foreach ($campos as $col => $val) {
                $setParts[] = "`$col` = ?";
                $vals[]     = $val;
            }

            $vals[] = $id;
            $sql = "UPDATE interfazadmin SET " . implode(', ', $setParts) . " WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($vals)) {
                header("Location: index.php?controlador=gestionInterfaz&metodo=editarInterfazEmpleado&update=ok");
                exit;
            } else {
                die("Error al actualizar el curso.");
            }


        }
    }

    public function ActualizarInterfazEmpleado() {
        
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = (int) $_POST['id'];
            $texto_inicio = trim($_POST['texto_inicio']);
            $texto_gestion1 = trim($_POST['texto_gestion1']);
            $texto_gestion2 = trim($_POST['texto_gestion2']);
            $titulo_gestion = trim($_POST['titulo_gestion']);
            $texto_consultar1 = trim($_POST['texto_consultar1']);
            $titulo_consultar = trim($_POST['titulo_consultar']);
            $texto_curso = trim($_POST['texto_curso']);
            $texto_soli = trim($_POST['texto_soli']);
            $titulo_soli = trim($_POST['titulo_soli']);

            require_once __DIR__ . '/../../config/connection_db.php';

            // 2) Preparar UPDATE dinámico
            $campos = [
                'texto_inicio'      => $texto_inicio,
                'texto_gestion1' => $texto_gestion1,
                'texto_gestion2'  => $texto_gestion2,
                'titulo_gestion'       => $titulo_gestion,
                'texto_consultar1'       => $texto_consultar1,
                'titulo_consultar'       => $titulo_consultar,
                'texto_curso'       => $texto_curso,
                'texto_soli' => $texto_soli,
                'titulo_soli'       => $titulo_soli
            ];

            // Montar SET clausula
            $setParts = [];
            $vals     = [];

            foreach ($campos as $col => $val) {
                $setParts[] = "`$col` = ?";
                $vals[]     = $val;
            }

            $vals[] = $id;
            $sql = "UPDATE interfazempleado SET " . implode(', ', $setParts) . " WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($vals)) {
                header("Location: index.php?controlador=gestionInterfaz&metodo=editarInterfazEmpleado&update=ok");
                exit;
            } else {
                die("Error al actualizar el curso.");
            }


        }
    }


    
}
?>