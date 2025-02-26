<?php
class Usuario{
    protected $id;
    protected $usuario;
    protected $clave;

    public function __construct($id, $usuario, $clave) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->clave = $clave;
    }

    public function __set($propiedad, $valor) {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }

    public function __toString() {
        return "Id: $this->id, Usuario: $this->usuario, Clave: $this->clave";
    }
}


// models/Usuario.php

class Usuario {
    private $db;

    // Constructor con la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Método para verificar las credenciales del usuario
    public function verificarCredenciales($username, $password) {
        // Prepara la consulta SQL para obtener el usuario
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Verifica si el usuario existe
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            // Compara la contraseña ingresada con la almacenada (suponiendo que está en formato hash)
            if (password_verify($password, $usuario['password'])) {
                return $usuario; // Retorna los datos del usuario si la autenticación es exitosa
            }
        }
        
        return null; // Retorna null si las credenciales son incorrectas
    }
}
