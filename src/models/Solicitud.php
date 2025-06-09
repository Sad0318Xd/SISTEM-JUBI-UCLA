<?php
class Solicitud {
    private $pdo;
    public $name;
    public $asunto;
    public $estado;
    public $empleado_solicitud_id;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /*public function CargarSolicitudes() {
        $sql = "SELECT * FROM solicitudes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":CI");
    }*/

    public function EnviarSolicitud() {
        $sql = "INSERT INTO solicitudes(name, asunto, estado, empleado_solicitud) VALUES (:name, :asunto, :estado, :empleado_solicitud)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":asunto", $this->asunto, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(":empleado_solicitud", $this->empleado_solicitud_id, PDO::PARAM_STR);
        return $stmt->execute();
    }

}
?>