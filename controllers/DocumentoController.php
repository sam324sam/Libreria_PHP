<?php
include '../models/Documento.php';

class DocumentoController {

    private $documentoModel;

    // Constructor recibe la conexión PDO
    public function __construct($pdo) {
        $this->documentoModel = new Documento($pdo);
    }

    // Método para obtener todos los documentos
    public function obtenerDocumentos() {
        return $this->documentoModel->obtenerDocumentos();
    }
}
