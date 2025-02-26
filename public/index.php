<?php
include 'controllers/DocumentoController.php';
include 'config/conexionBd.php';

// Crear el controlador de Documento
$documentoController = new DocumentoController($pdo);

// Obtener todos los documentos
$documentos = $documentoController->obtenerDocumentos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
</head>
<body>
    <h1>Lista de Documentos</h1>

    <?php if (!empty($documentos)): ?>
        <table border="1">
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
            <tbody>
                <?php foreach ($documentos as $documento): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($documento['id']); ?></td>
                        <td><?php echo htmlspecialchars($documento['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($documento['lista_autores']); ?></td>
                        <td><?php echo htmlspecialchars($documento['fecha_publicacion']); ?></td>
                        <td><?php echo htmlspecialchars($documento['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($documento['descripcion']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay documentos disponibles.</p>
    <?php endif; ?>
</body>
</html>
