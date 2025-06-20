<?php
class AutenticacionControlador {
    public function login(): void {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $usuarioInput = trim($_POST['usuario'] ?? '');
            $passwordInput = trim($_POST['password'] ?? '');

            if (empty($usuarioInput) || empty($passwordInput)) {
                $error = "Por favor, complete todos los campos.";
                include_once __DIR__ . '/../views/auth/login.php';
                return;
            }

            require_once __DIR__ . '/../../config/connection_db.php';
            require_once __DIR__ . '/../models/Usuario.php';

            $userModel = new Usuario($pdo);
            $usuario = $userModel->findByCI($usuarioInput);
            
            //password_verify($passwordInput, $usuario->password)
            if(!$usuario->CI) {
                $error = "Credenciales inválidas.";
                include_once __DIR__ . '/../views/auth/login.php';
                return;
            }
            if ($usuario->CI == $usuarioInput && $usuario->password == $passwordInput) {
                $_SESSION['ci'] = $usuario->CI;
                $_SESSION['name'] = $usuario->name;
                $_SESSION['lastname'] = $usuario->lastname;
                $_SESSION['rol'] = $usuario->rol;
                $_SESSION['fecha_ingreso'] = $usuario->fecha_ingreso;
                $_SESSION['edad'] = $usuario->edad;
                $_SESSION['departamento'] = $usuario->departamento;
                $_SESSION['cargo'] = $usuario->cargo;

                header("Location: index.php?controlador=inicio&metodo=inicio");
                exit();
                
            }else {
                $error = "Credenciales inválidas.";
                include_once __DIR__ . '/../views/auth/login.php';
                return;
            }

        } else {
            include_once __DIR__ . '/../views/auth/login.php';
        }
    }

    public function logout(): void {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>