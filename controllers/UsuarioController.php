<?php
require_once '../models/Usuario.php';
require_once '../config/conexionBd.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modeloUsuario = new Usuario($pdo);

    // Realizar Login
    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $clave = trim($_POST['clave']);

        if ($modeloUsuario->verificarCredenciales($email, $clave)) {
            $_SESSION['email'] = $email;
            header("Location: ../public/");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    }
    
    // Realizar Registro
    if (isset($_POST['registro'])) {
        $nombre = trim($_POST['nombre']);
        $direccion = trim($_POST['direccion']);
        $telefono = trim($_POST['telefono']);
        $curso = trim($_POST['curso']);
        $email = trim($_POST['email']);
        $clave = trim($_POST['clave']);

        // Validar si el email ya está registrado
        if ($modeloUsuario->obtenerUsuarioPorEmail($email)) {
            $error = "El correo ya está registrado.";
        } else {
            if ($modeloUsuario->registrarUsuario($nombre, $direccion, $telefono, $curso, $email, $clave)) {
                header("Location: ../views/usuarios/registro.php?mensaje=" . urlencode("Usuario registrado con éxito."));
                exit();
            } else {
                $error = "Error en el registro.";
            }
        }
    }
}

// Si hay error (Manda por GET el error)
if (!empty($error)) {
    header("Location: ../views/usuarios/login.php?error=" . urlencode($error));
    exit();
}
?>
