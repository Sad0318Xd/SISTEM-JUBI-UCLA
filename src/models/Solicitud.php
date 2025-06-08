<?php
class Solicitud {
    private $pdo;
    public $name;
    public $asunto;
    public $CI;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /*public function CargarSolicitudes() {
        $sql = "SELECT * FROM solicitudes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":CI");
    }*/

    public function EnviarSolicitud() {
        $sql = "INSERT INTO solicitudes(name, asunto) VALUES (:name, :asunto)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":asunto", $this->asunto, PDO::PARAM_STR);
        return $stmt->execute();
    }

}
?>