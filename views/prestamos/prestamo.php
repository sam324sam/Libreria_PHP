<?php
// views/prestamo.php
session_start();
require_once '../controllers/PrestamoController.php';

$prestamoController = new PrestamoController();
$id_usuario = $_SESSION['id_usuario'];
$id_libro = $_POST['id_libro'] ?? null;

if ($id_libro) {
    $resultado = $prestamoController->registrarPrestamo($id_usuario, $id_libro);
    echo json_encode($resultado);
} else {
    echo json_encode(['success' => false, 'message' => 'ID del libro no proporcionado.']);
}
