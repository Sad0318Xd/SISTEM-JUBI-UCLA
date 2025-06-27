<?php

class Curso {
    private $pdo;
    public $titulo;
    public $descripcion;
    public $imagen;
    public $instructor;
    public $fecha;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function CargarCursos() {
        $sql = "SELECT * FROM cursos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        if($stmt){
            return $stmt;
        }
        
    }

    public function AgregarCurso() {
        // Inserción en base de datos
        $sql = "INSERT INTO cursos (titulo, descripcion, instructor, fecha, imagen) VALUES (:titulo, :descripcion, :instructor, :fecha, :imagen)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $this->descripcion,PDO::PARAM_STR);
        $stmt->bindParam(':instructor', $this->instructor, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $this->imagen, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: index.php?controlador=gestionCursos&metodo=agregarCursosVistaAdmin&status=ok");
            exit;
        } else {
            echo "Error al insertar el curso.";
        }
    }

    public function EliminarCurso($id){

        // Primero obtengo la ruta de la imagen para borrarla
        $sql = "SELECT imagen FROM cursos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindparam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $curso = $stmt->fetch();

        // Borro el curso
        $sql = "DELETE FROM cursos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Eliminar la imagen si existe
            if (!empty($curso['imagen']) && file_exists($curso['imagen'])) {
                unlink($curso['imagen']);
            }

            header("Location: index.php?controlador=gestionCursos&metodo=cursosVistaAdmin&status=eliminado");
            exit;
        } else {
            echo "Error al eliminar el curso.";
        }
    }
}
?>