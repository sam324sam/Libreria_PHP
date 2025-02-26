<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

session_start();
include_once '../funciones/creacion_formulario_token.php';

if (!empty($_SESSION['usuario'])) {
    header('Location: ../gestionaFidelizaPuntos.php');
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errores = validarDatos();
    if (empty($errores)){
        header('Location: ../gestionaFidelizaPuntos.php');
    }else{
        generarFormularioLogin($_POST, $errores);
    }
}else{
    $datos = [];
    $errores = [];
    generarFormularioLogin($datos, $errores);
}

function generarFormularioLogin($datos, $errores){
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
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <main>
                <form action="index.php?controller=login&action=iniciarSesion" class="formulario" method="POST">
                    <div class = "input-container">
                        <label for="username">Nombre de usuario:</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class = "input-container">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class = "botones">
                        <button class="boton-enviar" type="submit" value="Ingresar">Enviar</button>
                    </div>
                </form>
            </main>
            <footer>

            </footer>
        </body>
        </html>
    ';
}

function validarDatos(){
    
    if (empty($errores) && login($_POST['usuario'], $_POST['clave'])) {
        header('Location: ../../');
    }else{
        $errores['login'] = "No se pudo iniciar sesion verifique los datos";
    }
    return $errores;
}

function login($usuario, $clave)
{
    include_once '../funciones/db.php';

    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE cemail = :cemail");
    $stmt->bindParam(':cemail', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($user) && $clave == $user['cclave']) {
        $_SESSION['usuario'] = $user['cemail'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['puntos'] = $user['puntos'] ?? 0;
        return true;
    } else {
        return false;
    }
}
