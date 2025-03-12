<?php
session_start();
if (!empty($_SESSION['email'])) {
    header('Location: ../../public/');
    exit();
}

if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo "<script>alert('$error');</script>";
}
?>

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
                <span class="nombre-web">Librería</span>
                <div class="usuario-opciones">
                    <span class="usuario" id="nombreUsuario"></span>
                    <span class="usuario" id="opcionesAdmin"></span>
                    <a href="../../views/usuarios/login.php" class="cerrar-sesion">Iniciar sesión</a>
                </div>
            </div>
        </nav>
        <nav class="nav-navegacion" aria-label="nav-navegacion">
            <div class="container-navegacion">
                <ul class="menu" id="navNavegacion">
                    <li><a href="../../public/">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <h2>Iniciar sesión</h2>
    <main>
        <form action="../../controllers/UsuarioController.php" class="formulario" method="POST">
            <input type="hidden" name="login" value="1">
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
            <div style="text-align: center;"><a href="registro.php" style="color: blue;">Registrar el usuario</a></div>
        </form>
    </main>
</body>

</html>
';
