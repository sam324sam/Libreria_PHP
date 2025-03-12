<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Préstamos</title>
    <link rel="stylesheet" href="../public/style.css">
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
    <nav class="nav-navegacion" aria-label="nav-navegacion">
        <div class="container-navegacion">
            <ul class="menu" id="navNavegacion">
                <li><a href="../public/index.php">Inicio</a></li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <h1>Mis Préstamos</h1>
    <div class="buscador">
                <input type="text" id="buscador" placeholder="🔍 Buscar por tipo de documento o nombre o autor..." onkeyup="filtrarDocumentos()">
    </div>
    <div id = "mensaje"></div>
    <div class="containerDocumentos">
        <?php
        if (!empty($prestamos)) {
            foreach ($prestamos as $prestamo) {
            echo '<div class="containerDatos item-documento" data-tipo = "'. htmlspecialchars($prestamo['tipo']).'" data-nombre = "'. htmlspecialchars($prestamo['titulo']).'"  data-autor = "'. htmlspecialchars($prestamo['lista_autores']).'">
              <p class = "otroMensaje">' . htmlspecialchars(ucfirst($prestamo['tipo'])) . '</p>
              <p class="tituloDocumento">' . htmlspecialchars($prestamo['titulo']) . '</p>
              <p><strong>Autor:</strong> ' . htmlspecialchars($prestamo['lista_autores']) . '</p>
              <p><strong>Fecha de publicación:</strong> ' . htmlspecialchars($prestamo['fecha_publicacion']) . '</p>
              <p><strong>Fecha de préstamo:</strong> ' . htmlspecialchars($prestamo['fecha_inicio']) . '</p>
              <p><strong>Fecha de devolucion:</strong> ' . htmlspecialchars($prestamo['fecha_fin']) . '</p>
            </div>';
            }
        } elseif (!empty($prestamosNoDevueltos)) {
            foreach ($prestamosNoDevueltos as $prestamo) {
                echo '<div class="containerDatos item-documento" data-tipo = "'. htmlspecialchars($prestamo['tipo']).'" data-nombre = "'. htmlspecialchars($prestamo['titulo']).'"  data-autor = "'. htmlspecialchars($prestamo['lista_autores']).'">
                  <p class = "otroMensaje">' . htmlspecialchars(ucfirst($prestamo['tipo'])) . '</p>
                  <p class="tituloDocumento">' . htmlspecialchars($prestamo['titulo']) . '</p>
                  <p><strong>Autor:</strong> ' . htmlspecialchars($prestamo['lista_autores']) . '</p>
                  <p><strong>Fecha de publicación:</strong> ' . htmlspecialchars($prestamo['fecha_publicacion']) . '</p>
                  <p><strong>Fecha de préstamo:</strong> ' . htmlspecialchars($prestamo['fecha_inicio']) . '</p>
                  <p><strong>Fecha de devolucion:</strong> ' . htmlspecialchars($prestamo['fecha_fin']) . '</p>
                  <p class="mensaje">Usted no a devuelto este prestamo en la fecha acordada</p>
                </div>';
                }
        }else {
            echo '<p class="mensaje">No tienes préstamos.</p>';
        }
        ?>
    </div>
</main>
<footer class="footer">
    <div class="footer-container">
        <p>&copy; 2025 Gestión FCT. Todos los derechos reservados.</p>
    </div>
</footer>
<script>
    function filtrarDocumentos() {
        let hayDocumentos = false;
        const mensaje = document.getElementById('mensaje');
        const filtro = document.getElementById('buscador').value.toLowerCase();
        // OBTENEMOS TODOS LOS ELEMENTOS A PARTIR DE SU CLASE
        const items = document.querySelectorAll('.item-documento');
        // ITERAMOS CADA ITEM Y FILTRAMOS POR SUS VALORES DATA
        items.forEach(item => {
            const tipo = item.getAttribute('data-tipo');
            const titulo = item.getAttribute('data-nombre').toLowerCase();
            const autor = item.getAttribute('data-autor').toLowerCase();
            
            // SI EL DATA COINCIDE CON LO INSERTADO EN EL BUSCADOR SE MUESTRA
            if (tipo.includes(filtro) || titulo.includes(filtro) || autor.includes(filtro)) {
                hayDocumentos = true;
                item.style.display = "block";
                mensaje.innerHTML = '';
            } else {
                item.style.display = "none";
            }
        });

        if(!hayDocumentos){
            mensaje.innerHTML = '<p class = "mensaje">No hay documentos disponibles</p>';
        }
    }
    </script>
</body>
</html>