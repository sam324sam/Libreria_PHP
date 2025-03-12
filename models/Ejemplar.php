<?php
// models/Ejemplar.php
class Ejemplar {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Obtener un ejemplar disponible de un documento
    public function obtenerEjemplarDisponible($id_documento) {
        $stmt = $this->db->prepare("SELECT id FROM ejemplar WHERE id_documento = ? AND prestado = 0 LIMIT 1");
        $stmt->execute([$id_documento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Comprobar existencias disponibles de un documento
    public function contarDisponibles($id_documento) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS disponibles FROM ejemplar WHERE id_documento = ? AND prestado = 0");
        $stmt->execute([$id_documento]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['disponibles'];
    }

    // Marcar un ejemplar como prestado
    public function marcarComoPrestado($id_ejemplar) {
        $stmt = $this->db->prepare("UPDATE ejemplar SET prestado = 1 WHERE id = ?");
        return $stmt->execute([$id_ejemplar]);
    }
}
