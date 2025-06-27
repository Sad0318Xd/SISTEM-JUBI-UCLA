<?php

class CursosControlador {
    public function ActualizarCurso(): void {

        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once __DIR__ . '/../../config/connection_db.php';
            require_once __DIR__ . '/../models/Curso.php';
            
            // Validar sesión...
            if (!isset($_SESSION['ci'])) {
                header("Location: index.php?controlador=autenticacion&metodo=login");
                exit;
            }

            $id = (int) $_POST['id'];
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $instructor = trim($_POST['instructor']);
            $fecha = $_POST['fecha'];
            $rutaImagen = null;

            // 1) Si subieron un archivo sin errores...
            if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tmpName  = $_FILES['imagen']['tmp_name'];
                $mime     = mime_content_type($tmpName);
                $ext      = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $allowed  = ['jpg','jpeg','png','gif'];

                // Validar extensión
                if (!in_array($ext, $allowed) || !preg_match('#^image/#', $mime)) {
                    die("Formato de imagen no válido.");
                }

                // Crear nombre único
                $newName  = uniqid('curso_', true) . '.' . $ext;
                $destDir  = 'updates/';
                if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                $destPath = $destDir . $newName;

                // Mover archivo
                if (!move_uploaded_file($tmpName, $destPath)) {
                    die("Error al guardar la imagen.");
                }

                // Generar la ruta web accesible
                $rutaImagen = 'updates/' . $newName;

                // (Opcional) Borrar la imagen antigua
                $sql_old = "SELECT imagen FROM cursos WHERE id = ?";
                $st_old  = $pdo->prepare($sql_old);
                $st_old->execute([$id]);
                $old     = $st_old->fetchColumn();
                if ($old && file_exists(__DIR__ . $old)) {
                    unlink(__DIR__ . $old);
                }
            }

            $curso = new Curso($pdo);
            
            // 2) Preparar UPDATE dinámico
            $campos = [
                'titulo'      => $titulo,
                'descripcion' => $descripcion,
                'instructor'  => $instructor,
                'fecha'       => $fecha
            ];

            if ($rutaImagen) {
                $campos['imagen'] = $rutaImagen;

                // Primero obtengo la ruta de la imagen para borrarla
                $sql = "SELECT imagen FROM cursos WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindparam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $curso = $stmt->fetch();


                // Eliminar la imagen si existe
                if (!empty($curso['imagen']) && file_exists($curso['imagen'])) {
                    unlink($curso['imagen']);
                }
            }

            // Montar SET clausula
            $setParts = [];
            $vals     = [];

            foreach ($campos as $col => $val) {
                $setParts[] = "`$col` = ?";
                $vals[]     = $val;
            }

            $vals[] = $id;
            $sql = "UPDATE cursos SET " . implode(', ', $setParts) . " WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($vals)) {
                header("Location: index.php?controlador=gestionCursos&metodo=cursosVistaAdmin");
                exit;
            } else {
                die("Error al actualizar el curso.");
            }
        } else {
            include_once __DIR__ . '/../views/admin/editarCursos.php';
        }
    }

    public function AgregarCurso(){

        require_once __DIR__ . '/../../config/connection_db.php';
        require_once __DIR__ . '/../models/Curso.php';

        // Verifica que se enviaron todos los datos requeridos
        if (
            isset($_POST['titulo']) &&
            isset($_POST['descripcion']) &&
            isset($_POST['instructor']) &&
            isset($_POST['fecha'])
        ) {
            $curso = new Curso($pdo);

            $curso->titulo = $_POST['titulo'];
            $curso->descripcion = $_POST['descripcion'];
            $curso->instructor = $_POST['instructor'];
            $curso->fecha = $_POST['fecha'];
            $curso->imagen = null;

            // Manejar la carga de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorio = 'uploads/';
                $nombreTemporal = $_FILES['imagen']['tmp_name'];
                $nombreFinal = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $rutaDestino = $directorio . $nombreFinal;

                if (!file_exists($directorio)) {
                    mkdir($directorio, 0755, true);
                }

                if (move_uploaded_file($nombreTemporal, $rutaDestino)) {
                    $curso->imagen = $rutaDestino;
                }
            }

            $curso->AgregarCurso();
        
        } else {
            echo "Faltan datos del formulario.";
        }
    }

    public function eliminarCurso(){
        
        require_once __DIR__ . '/../../config/connection_db.php';
        require_once __DIR__ . '/../models/Curso.php';

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $curso = new Curso($pdo);

            $curso->EliminarCurso($id);
        } else {
            echo "ID de curso no proporcionado.";
        }
    }

    
}