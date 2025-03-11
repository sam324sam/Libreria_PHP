<?php
require_once '../models/Prestamo.php';
require_once '../config/conexionBd.php';

class PrestamoController {
    private $pdo;
    private $prestamoModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->prestamoModel = new Prestamo($this->pdo);
    }

    public function solicitarPrestamo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'] ?? null;
            $id_documento = $_POST['id_documento'] ?? null;
            if (!$id_usuario || !$id_documento) {
                $resultado = 'Faltan datos';
            }else{
                $resultado = $this->prestamoModel->registrarPrestamo($id_usuario, $id_documento);
            }

            
        }
        header("Location: ../public/index.php?resultado=" . urlencode($resultado));
    }
}

$controller = new PrestamoController($pdo);
$controller->solicitarPrestamo();
