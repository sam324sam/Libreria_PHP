<?php
// models/Usuario.php
require_once '../config/conexionBd.php';

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function verificarCredenciales($usuario, $clave) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && $clave == $user['clave']) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            return true;
        }
        return false;
    }

    public function registrarUsuario($nombre, $direccion, $telefono, $curso, $email, $clave) {
        $stmt = $this->pdo->prepare("INSERT INTO usuario (nombre, direccion, telefono, curso, email, clave) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $direccion, $telefono, $curso, $email, $clave]);
    }

    public function obtenerUsuarioPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
