<?php
// models/Prestamo.php
class Prestamo {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }

    // 3.1. Comprobar existencias de ejemplar
    public function comprobarExistencias($id_libro) {
        $stmt = $this->db->prepare("SELECT ejemplares_disponibles FROM libros WHERE id = ?");
        $stmt->execute([$id_libro]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado && $resultado['ejemplares_disponibles'] > 0;
    }
    
    // 3.2. Comprobar que el usuario no tenga más de 6 préstamos activos
    public function comprobarMaximoPrestamos($id_usuario) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM prestamos WHERE id_usuario = ? AND devuelto = 0");
        $stmt->execute([$id_usuario]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] < 6;
    }
}
