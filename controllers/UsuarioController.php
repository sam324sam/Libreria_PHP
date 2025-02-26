<?php
// controllers/LoginController.php

require_once 'models/Usuario.php';

class LoginController {

    private $usuarioModel;

    // Constructor con la conexión a la base de datos y el modelo de Usuario
    public function __construct($db) {
        $this->usuarioModel = new Usuario($db);
    }

    // Acción para mostrar el formulario de login
    public function mostrarFormulario() {
        include 'views/usuarios/login.php';
    }

    // Acción para procesar el login
    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtiene las credenciales del formulario
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Verifica las credenciales con el modelo
            $usuario = $this->usuarioModel->verificarCredenciales($username, $password);

            if ($usuario) {
                // Iniciar sesión: almacenar los datos del usuario en la sesión
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['username'];

                // Redirigir a la página de inicio (puedes cambiar la URL a la que desees)
                header("Location: dashboard.php");
                exit();
            } else {
                // Si las credenciales son incorrectas, muestra un error
                $error = "Usuario o contraseña incorrectos.";
                include 'views/usuarios/login.php';
            }
        }
    }
}
