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

if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
    echo "<script>alert('$mensaje');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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

    <h2>Registro de usuario</h2>
    <main>
        <form action="../../controllers/UsuarioController.php" class="formulario" method="POST">
            <input type="hidden" name="registro" value="1">
            
            <div class="input-container">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>

            <div class="input-container">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" required>
            </div>

            <div class="input-container">
                <label for="telefono">Teléfono:</label>
                <input type="number" name="telefono" id="telefono" required>
            </div>

            <div class="input-container">
                <label for="curso">Curso:</label>
                <input type="number" name="curso" id="curso" required>
            </div>

            <div class="input-container">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="input-container">
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave" required>
            </div>

            <div class="botones">
                <button class="boton-enviar" type="submit">Registrar</button>
            </div>
            <div style="text-align: center;"><a href="login.php" style="color: blue;">Volver al inicio de sesión</a></div>
        </form>
    </main>
</body>

</html>
