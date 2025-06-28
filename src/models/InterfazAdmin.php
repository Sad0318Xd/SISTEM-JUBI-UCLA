<?php

class InterfazAdmin {
    private $pdo;
    public $descripcion;
    public $titulo_inicio_solicitudes;
    public $texto_inicio_solicitudes;
    public $texto2_inicio_solicitudes;
    public $titulo_listado_solicitudes;
    public $titulo_gestion_cursos;
    public $texto_inicio_cursos; 
    public $texto2_inicio_cursos;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function CargarInterfaz($id) {
        $sql = "SELECT * FROM interfazadmin WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindparam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt){
            return $stmt;
        }
        
    }

    public function AgregarCurso() {
    
    }

    public function EliminarCurso($id){

    }
}
?>