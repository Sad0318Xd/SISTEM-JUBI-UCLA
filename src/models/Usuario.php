<?php
class Usuario {
    private $pdo;
    public $CI;
    public $name; 
    public $lastname; 
    public $password; 
    public $rol;
    public $fecha_ingreso;
    public $edad;
    public $departamento;
    public $telefono;
    public $cargo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }
    
    public function findByCI($CI) {
        $sql = "SELECT * FROM usuarios WHERE CI = :CI";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":CI", $CI, PDO::PARAM_STR);
        $stmt->execute();
        $userData = $stmt->fetch();

        if ($userData) {

            $this->CI = $userData['CI'];
            $this->name = $userData['name'];
            $this->lastname = $userData['lastname'];
            $this->password = $userData['password'];
            $this->rol = $userData['rol'];
            $this->fecha_ingreso = $userData['fecha_ingreso'];
            $this->edad = $userData['edad'];
            $this->departamento = $userData['departamento'];
            $this->telefono = $userData['telefono'];
            $this->cargo = $userData['cargo'];
            return $this;
        }
        return null;
    }

    public function save() {
        $sql = "INSERT INTO usuarios(CI, name, password, rol) VALUES (:CI, :name, :password, :rol)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":CI", $this->CI, PDO::PARAM_STR);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
        $stmt->bindParam(":rol", $this->rol, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>