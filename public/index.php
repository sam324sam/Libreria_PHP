<?php
include '../controllers/DocumentoController.php';
include '../config/conexionBd.php';

// Crear el controlador de Documento
$documentoController = new DocumentoController($pdo);

// Obtener todos los documentos
$documentos = $documentoController->obtenerDocumentos();

function generaListado($documentos) {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Documentos</title>
    </head>
    <body>
        <h1>Lista de Documentos</h1>';
    
    if (!empty($documentos)) {
        echo '<table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autores</th>
                    <th>Fecha de Publicación</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>';
                
        foreach ($documentos as $documento) {
            echo '<tr>
                <td>' . htmlspecialchars($documento['id']) . '</td>
                <td>' . htmlspecialchars($documento['titulo']) . '</td>
                <td>' . htmlspecialchars($documento['lista_autores']) . '</td>
                <td>' . htmlspecialchars($documento['fecha_publicacion']) . '</td>
                <td>' . htmlspecialchars($documento['tipo']) . '</td>
                <td>' . htmlspecialchars($documento['descripcion']) . '</td>
            </tr>';
        }
        
        echo '</tbody>
        </table>';
    } else {
        echo '<p>No hay documentos disponibles.</p>';
    }
    
    echo '</body>
    </html>';
}

// Llamar a la función para mostrar el HTML
generaListado($documentos);
?>
