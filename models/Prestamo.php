<?php
// models/Prestamo.php

require_once 'Ejemplar.php';

class Prestamo {
    private $db;
    private $ejemplar;

    public function __construct($database) {
        $this->db = $database;
        $this->ejemplar = new Ejemplar($database); // Instanciamos el modelo Ejemplar
    }

    // Comprobar si el usuario tiene menos de 6 préstamos activos
    public function comprobarMaximoPrestamos($id_usuario) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM prestar WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] < 6;
    }

    // Registrar un préstamo si se cumplen las condiciones
    public function registrarPrestamo($id_usuario, $id_documento) {
        if (!$this->comprobarMaximoPrestamos($id_usuario)) {
            return "El usuario ya tiene 6 préstamos activos.";
        }

        // Consultamos si hay ejemplares disponibles
        $disponibles = $this->ejemplar->contarDisponibles($id_documento);
        $ejemplarDisponible = $this->ejemplar->obtenerEjemplarDisponible($id_documento);

        if ($disponibles <= 0 || empty($ejemplarDisponible)) {
            return "No hay ejemplares disponibles.";
        }

        // Registrar el préstamo
        $fecha = new DateTime();
        $stmt = $this->db->prepare("INSERT INTO prestar (id_usuario, id_ejemplar, fecha_fin) VALUES (?, ?, DATE_ADD(?, INTERVAL 21 DAY))");
        $stmt->execute([$id_usuario, $ejemplarDisponible['id'], $fecha->format("Y-m-d H:i:s")]);

        // Marcar el ejemplar como prestado
        $this->ejemplar->marcarComoPrestado($ejemplarDisponible['id']);

        return "Préstamo registrado correctamente.";
    }

    // parte para las views
    public function listarPrestamos($id_usuario){
        $stmt = $this->db->prepare("SELECT * FROM documento INNER JOIN ejemplar on documento.id = ejemplar.id_documento INNER JOIN prestar on ejemplar.id = prestar.id_ejemplar
        WHERE prestar.id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPrestamosNoDevueltos($id_usuario){
        $stmt = $this->db->prepare("SELECT * FROM documento INNER JOIN ejemplar on documento.id = ejemplar.id_documento INNER JOIN prestar on ejemplar.id = prestar.id_ejemplar
        WHERE prestar.id_usuario = ? AND prestar.fecha_fin < NOW()");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
