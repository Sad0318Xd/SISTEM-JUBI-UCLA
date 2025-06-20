<?php
class Solicitud {
    private $pdo;
    public $name;
    public $asunto;
    public $estado;
    public $fecha_creacion;
    public $empleado_solicitud_id;
    public $fecha_cambio;

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

        $sql = "SELECT * FROM solicitudes";
        $params = [];

        if (!empty($CI)) {
            $sql .= " WHERE empleado_solicitud = :CI";
            $params[':CI'] = $CI;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        //$soliData = $stmt->fetch();
        if($stmt)
        {
            return $stmt;
        }
        /*if ($soliData) {
            $this->fecha_creacion = $soliData['fecha_creacion'];
            $this->estado = $soliData['estado'];
            return $this;
        }*/
        return null;
    }

    public function FindSolicByStatus($Status) {

        $sql = "SELECT * FROM solicitudes";
        $params = [];

        if (!empty($Status)) {
            $sql .= " WHERE estado = :estado";
            $params[':estado'] = $Status;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        if ($stmt) {
            return $stmt;
        }
        return null;
    }

    

     public function TotalSolicitudes($Status) {

        $sql_count = "SELECT COUNT(*) as total FROM solicitudes";
        if (!empty($Status)) {
            $sql_count .= " WHERE estado = :estado";
        }
        $stmt_count = $this->pdo->prepare($sql_count);
        if (!empty($Status)) {
            $stmt_count->execute([':estado' => $Status]);
        } else {
            $stmt_count->execute();
        }
        $total_solicitudes = $stmt_count->fetch()['total'];

        if ($total_solicitudes) {
            return $total_solicitudes;
        }
        return null;
    }

    public function TotalSolicitudesByCI($ci) {

        $sql_count = "SELECT COUNT(*) as total FROM solicitudes";
        if (!empty($ci)) {
            $sql_count .= " WHERE empleado_solicitud = :ci";
        }
        $stmt_count = $this->pdo->prepare($sql_count);
        if (!empty($ci)) {
            $stmt_count->execute([':ci' => $ci]);
        } else {
            $stmt_count->execute();
        }
        $total_solicitudes = $stmt_count->fetch()['total'];

        if ($total_solicitudes) {
            return $total_solicitudes;
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