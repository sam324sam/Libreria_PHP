<?php
require_once '../models/Usuario.php';
require_once '../config/database.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $clave = trim($_POST['clave']);

    $modeloUsuario = new Usuario($pdo);

    if ($modeloUsuario->verificarCredenciales($email, $clave)) {
        $_SESSION['email'] = $email;
        header("Location: ../public/index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}

// Si hay error (Manda por get el error)
if (!empty($error)) {
    header("Location: ../views/usuarios/login.php?error=" . urlencode($error));
    exit();
}
