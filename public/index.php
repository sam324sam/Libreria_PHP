<?php

include '../controllers/DocumentoController.php';
include '../config/conexionBd.php';

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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <nav class="nav-usuario" aria-label="nav-usuario">
            <div class="container-usuario">
                <span class="nombre-web">Librería</span>
                <div class="usuario-opciones">
                    <?php

                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    
                    if (isset($_SESSION['id'])) {
                        echo '<span class = "usuario">'.$_SESSION['email'].'</span>
                        <span><a href="../controllers/PrestamoController.php?ver_prestamos=true" class="cerrar-sesion">Ver documentos prestados</a></span>
                        <span><a href="../controllers/PrestamoController.php?ver_prestamos_no_devueltos=true" class="cerrar-sesion">Ver documentos no devueltos</a></span>
                        </span"><a href="../views/usuarios/logout.php" class="cerrar-sesion">Cerrar sesión</a>';
                    } else{
                        echo '<a href="../views/usuarios/login.php" class="cerrar-sesion">Iniciar sesión</a>';
                    }

                    ?>
                </div>
            </div>
        </nav>
        <nav class="nav-navegacion">
            <div class="container-navegacion">
                <ul class="menu" id="navNavegacion">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="buscador">
                <input type="text" id="buscador" placeholder="🔍 Buscar por tipo de documento o nombre..." onkeyup="filtrarDocumentos()">
        </div>
        <div id = "mensaje">
        </div>
        <div >
            <?php
                if ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_GET['resultado'])) {
                    echo '<p class = "mensajeAzul">'.$_GET['resultado'].'</p>';
                }
            ?>
        </div>
        <div class="containerDocumentos">
    <?php
    // Verificar si el array de documentos no está vacío
    if (!empty($documentos)) {
        // Recorrer el array de documentos y mostrar los datos en las filas de la tabla
        foreach ($documentos as $documento) {
            echo '<div class="containerDatos item-documento" data-tipo = "'. htmlspecialchars($documento['tipo']).'" data-nombre = "'. htmlspecialchars($documento['titulo']).'"  data-autor = "'. htmlspecialchars($documento['lista_autores']).'">
                <p class = "otroMensaje">' . htmlspecialchars(ucfirst($documento['tipo'])) . '</p>
                <p class = "tituloDocumento">' . htmlspecialchars($documento['titulo']) . '</p>
                <p>' . htmlspecialchars($documento['lista_autores']) . '</p>
                <p>' . htmlspecialchars($documento['fecha_publicacion']) . '</p>
                <p>' . htmlspecialchars($documento['descripcion']) . '</p>';
                if (!empty($_SESSION['email'])) {
                    echo '
                        <form action="../controllers/PrestamoController.php" method="POST">
                            <input type="hidden" name="id_documento" value="'.htmlspecialchars($documento['id']).'">
                            <input type="hidden" name="id_usuario" value="'.htmlspecialchars($_SESSION['id']).'">
                            <center><button type="submit" class="boton-enviar">Solicitar Préstamo</button></center>
                        </form>';
                }
            echo '</div>';
        }
    } else {
        // Si no hay documentos, mostrar un mensaje
        echo '<p class = "mensaje">No hay documentos disponibles.</p>';
    }
    ?>
        </div>
    </main>
    <footer class = "footer">
    <div class="footer-container">
            <p>&copy; 2025 Gestión FCT. Todos los derechos reservados.</p>
        </div>
</footer>
<script>
    function filtrarDocumentos() {
        let hayDocumentos = false;
        const mensaje = document.getElementById('mensaje');
        const filtro = document.getElementById('buscador').value.toLowerCase();
        const items = document.querySelectorAll('.item-documento');
        items.forEach(item => {
            const tipo = item.getAttribute('data-tipo');
            const titulo = item.getAttribute('data-nombre').toLowerCase();
            const autor = item.getAttribute('data-autor').toLowerCase();

            if (tipo.includes(filtro) || titulo.includes(filtro) || autor.includes(filtro)) {
                hayDocumentos = true;
                item.style.display = "block";
                mensaje.innerHTML = '';
            } else {
                item.style.display = "none";
            }
            if(!hayDocumentos){
                mensaje.innerHTML = '<p class = "mensaje">No hay documentos disponibles</p>';
            }
        });
    }
</script>
</body>
</html>
