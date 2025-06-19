<?php
class Solicitud {
    private $pdo;
    public $name;
    public $asunto;
    public $estado;
    public $fecha_creacion;
    public $empleado_solicitud_id;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ChangesStatus($CI, $nuevoEstado) {
        $sql = "UPDATE solicitudes SET estado = :estado WHERE empleado_solicitud = :CI";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':estado', $nuevoEstado);
        $statement->bindParam(':CI', $CI);
        $statement->execute();
    }

    public function FindSolicByCI($CI) {
        $sql = "SELECT * FROM solicitudes WHERE empleado_solicitud = :CI";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":CI", $CI, PDO::PARAM_STR);
        $stmt->execute();
        $soliData = $stmt->fetch();

        if ($soliData) {
            $this->fecha_creacion = $soliData['fecha_creacion'];
            $this->estado = $soliData['estado'];
            return $this;
        }
        return null;
    }

    public function EnviarSolicitud() {
        $sql = "INSERT INTO solicitudes(name, asunto, estado, empleado_solicitud) VALUES (:name, :asunto, :estado,  :empleado_solicitud)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":asunto", $this->asunto, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(":empleado_solicitud", $this->empleado_solicitud_id, PDO::PARAM_STR);
        return $stmt->execute();
    }

}
?>