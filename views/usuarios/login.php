<?php
session_start();
if (!empty($_SESSION['email'])) {
    header('Location: ../public/index.php');
    exit();
}

if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo "<script>alert('$error');</script>";
}
echo '

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/style.css">
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

    <h2>Iniciar sesión</h2>
    <main>
        <form action="../../controllers/UsuarioController.php" class="formulario" method="POST">
            <div class="input-container">
                <label for="email">Nombre de usuario:</label>
                <input type="text" name="email" id="email">
            </div>
            <div class="input-container">
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave">
            </div>
            <div class="botones">
                <button class="boton-enviar" type="submit">Ingresar</button>
            </div>
        </form>
    </main>
</body>

</html>
';
