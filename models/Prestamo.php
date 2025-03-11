<?php
// models/Prestamo.php
class Prestamo {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }

    public function obtenerIdEjemplar($id_documento){
        $stmt = $this->db->prepare("SELECT id FROM ejemplar WHERE id_documento = ? AND prestado = 0");
        $stmt->execute([$id_documento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3.1. Comprobar existencias de ejemplares disponibles
    public function comprobarExistencias($id_documento) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS disponibles FROM ejemplar WHERE id_documento = ? AND prestado = 0");
        $stmt->execute([$id_documento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // 3.2. Comprobar que el usuario no tenga más de 6 préstamos activos
    public function comprobarMaximoPrestamos($id_usuario) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM prestar WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] < 6;
    }

    // 3.3. Registrar un prestamo si se cumplen las condiciones
    public function registrarPrestamo($id_usuario, $id_documento) {
        if (!$this->comprobarMaximoPrestamos($id_usuario)) {
            return "El usuario ya tiene 6 préstamos activos.";
        }

        $disponibles = $this->comprobarExistencias($id_documento);
        $id_disponible = $this->obtenerIdEjemplar($id_documento);
        print_r($id_disponible);
        if ($disponibles <= 0) {
            return "No hay ejemplares disponibles.";
        }

        // Registrar el prestamo
        $fecha = new DateTime();
        $stmt = $this->db->prepare("INSERT INTO prestar (id_usuario, id_ejemplar, fecha_fin) VALUES (?, ?, DATE_ADD(?, INTERVAL 21 DAY))");
        $stmt->execute([$id_usuario, $id_disponible['id'], $fecha->format("Y-m-d H:i:s")]);

        $stmt->execute([$id_usuario, $id_disponible['id'], $fecha->format("Y-m-d H:i:s")]);

        // Marcar el ejemplar como prestado
        $stmt = $this->db->prepare("UPDATE ejemplar SET prestado = 1 WHERE id = ?");
        $stmt->execute([$id_disponible['id']]);

        return "Préstamo registrado correctamente.";
    }
}
