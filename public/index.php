
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Login</title>
            <link rel="stylesheet" href="/style.css">
        </head>
        <body>
        <header>
                <nav class="nav-usuario" aria-label="nav-usuario">
                    <div class="container-usuario">
                        <span class="nombre-web">Gestión FCT</span>
                        <div class="usuario-opciones">
                            <span class="usuario" id="nombreUsuario"></span>
                            <span class="usuario" id="opcionesAdmin"></span>
                            <a class="cerrar-sesion" href="http://localhost:3000/logout">Cerrar sesión</a>
                        </div>
                    </div>
                </nav>
                <nav class="nav-navegacion" aria-label="nav-navegacion">
                    <div class="container-navegacion">
                        <ul class="menu" id="navNavegacion">
                            <li><a href="../profesorDashboard/listas.html?tipo=alumnos">Alumnos</a></li>
                            <li><a href="../profesorDashboard/listas.html?tipo=empresas">Empresas</a></li>
                            <li><a href="../profesorDashboard/menuProfesor.html">Inicio</a></li>
                            <li><a href="../profesorDashboard/listas.html?tipo=representantes">Representantes</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
            <main>
                <form action="index.php?controller=login&action=iniciarSesion" class="formulario" method="POST">
                    
                </form>
            </main>
            <footer>

            </footer>
        </body>
        </html>

<?php
function 