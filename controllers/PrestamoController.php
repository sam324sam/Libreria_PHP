<?php
require_once '../models/Prestamo.php';
require_once '../config/conexionBd.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
            header("Location: ../public/index.php?resultado=" . urlencode($resultado));
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_SESSION['id'])) {
            
        }
    }
}

$controller = new PrestamoController($pdo);
$controller->solicitarPrestamo();
