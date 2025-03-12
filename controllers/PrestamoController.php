<?php
include '../models/Prestamo.php';
include '../config/conexionBd.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class PrestamoController {
    private $pdo;
    private $prestamoModel;

    // CREAMOS CONTRUCTOR PASANDO POR PARAMETRO EL PDO OBTENIDO DEL INCLUDE DEL conexionBd.php Y CREAMOS UN NUEVO PRESTAMO
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->prestamoModel = new Prestamo($this->pdo);
    }

    // SOLICITA EL PRESTAMO OBTENIENDO POR POST LOS DATOS Y HACE USO DE FUNCIONES DE LA CLASE Prestamo
    public function solicitarPrestamo() {
        $id_usuario = $_POST['id_usuario'] ?? null;
        $id_documento = $_POST['id_documento'] ?? null;
        if (!$id_usuario || !$id_documento) {
            $resultado = 'Faltan datos';
        } else {
            $resultado = $this->prestamoModel->registrarPrestamo($id_usuario, $id_documento);
        }
        header("Location: ../public/index.php?resultado=" . urlencode($resultado));
        exit;
    }

    // LLAMA A VIEWS EN ESTE CASO DE PRESTAMOS, CON LOS DATOS, DE DOCUMENTOS PRESTADOS, RECOGIDOS POR UNA FUNCION DE
    // LA CLASE Prestamo (DEVUELVE UN FETCHALL DE LO FILTRADO)
    public function verPrestamos() {
        // Verificamos la sesion
        if (!empty($_SESSION['id'])) {
            $prestamos = $this->prestamoModel->listarPrestamos($_SESSION['id']);
            // Mostramos la vista
            include '../views/prestamos/prestamo.php';
            exit;
        } else {
            header("Location: ../views/usuarios/login.php");
            exit;
        }
    }
}

// HACEMOS USO DE LAS FUNCIONES DEL CONTROLADOR
$controller = new PrestamoController($pdo);

// DECLARAMOS QUE SI ES POST SE VA A REALIZAR UNA OSLICITUD DE PRESTAMO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->solicitarPrestamo();
}

// EN CASO DE SER GET OBTENEMOS POR LA URL EL VALOR, EN ESTE CASO ES LA ACCION A REALIZAR QUE ES VER LOS PRESTAMOS POR USUARIO
// (N ESTE CASO ESTE CONTROLADOR DE ACCION NO SERIA NECESARIO)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ver_prestamos'])) {
    $controller->verPrestamos();
}
?>
