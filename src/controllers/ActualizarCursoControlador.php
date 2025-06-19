<?php

class ActualizarCursoControlador {
    public function ActualizarCurso(): void {

        session_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once __DIR__ . '/../../config/connection_db.php';
            
            // Validar sesión...
            if (!isset($_SESSION['ci'])) {
                header("Location: index.php?controlador=autenticacion&metodo=login");
                exit;
            }

            $id          = (int) $_POST['id'];
            $titulo      = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            $instructor  = trim($_POST['instructor']);
            $fecha       = $_POST['fecha'];
            $rutaImagen  = null;

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
                $destDir  = __DIR__ . '/../img/cursos/';
                if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                $destPath = $destDir . $newName;

                // Mover archivo
                if (!move_uploaded_file($tmpName, $destPath)) {
                    die("Error al guardar la imagen.");
                }

                // Generar la ruta web accesible
                $rutaImagen = '../src/img/cursos/' . $newName;

                // (Opcional) Borrar la imagen antigua
                $sql_old = "SELECT imagen FROM cursos WHERE id = ?";
                $st_old  = $pdo->prepare($sql_old);
                $st_old->execute([$id]);
                $old     = $st_old->fetchColumn();
                if ($old && file_exists(__DIR__ . $old)) {
                    unlink(__DIR__ . $old);
                }
            } 

            // 2) Preparar UPDATE dinámico
            $campos = [
                'titulo'      => $titulo,
                'descripcion' => $descripcion,
                'instructor'  => $instructor,
                'fecha'       => $fecha
            ];

            if ($rutaImagen) {
                $campos['imagen'] = $rutaImagen;
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
                header("Location: index.php?controlador=gestionCursos&metodo=editSuccess");
                exit;
            } else {
                die("Error al actualizar el curso.");
            }
        } else {
            include_once __DIR__ . '/../views/admin/editarCursos.php';
        }
    }
}