<?php
$dsn = "mysql:host=localhost;dbname=mi_base_de_datos;charset=utf8mb4";
$usuario = "root";
$clave = "";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $usuario, $clave, $options);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
