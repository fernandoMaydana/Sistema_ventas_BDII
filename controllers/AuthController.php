<?php

class AuthController {

    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Credenciales genéricas (Hardcoded)
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['user'] = 'Administrador Kwik-E-Mart';
                header("Location: index.php");
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        }

        // Mostrar vista de login (No usa layout main porque es pantalla completa)
        require_once 'views/auth/login.php';
    }

    public function logout() {
        // Destruir todas las variables de sesión
        $_SESSION = array();
        session_destroy();
        
        // Redirigir al login
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
?>
