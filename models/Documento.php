<?php
class Documento {
    private $pdo;

    // Recibimos la conexión PDO en el constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Este método obtiene todos los documentos
    public function obtenerDocumentos() {
        $query = "SELECT * FROM documento";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
