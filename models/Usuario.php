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
}
