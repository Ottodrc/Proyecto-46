<?php
require("session.php");
?>
<?php
//una vez logueado el usuario no se tiene que loguear
if (isset($_SESSION["usuario"])) {
    header("Location:menu.php");
    exit();
}
?>
<?php
//para saber si llamo la 1ra vez o la 2da, si no hay nada en usuario baja al form, sino
if (isset($_POST["usuario"])) {
    //conecto a base de datos
    $conexion = new mysqli("localhost", "root", "123456789", "usuarios");
    if (!$conexion) {
        die("No hemos podido conectarnos a la base de datos:" . mysqli_connect_errno());
    };
    //paso las variables por post
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["password"];
    //querys a resultado
    $queryUsuario = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultadoUsuario = mysqli_query($conexion, $queryUsuario);

    $queryContrasena = "SELECT * FROM usuarios WHERE contrasena = '$contrasena'";
    $resultadoContrasena = mysqli_query($conexion, $queryContrasena);
    //si trajo resultados
    if (mysqli_num_rows($resultadoUsuario) > 0 && mysqli_num_rows($resultadoContrasena) > 0) {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["contrasena"] = $contrasena;
        header('Location:menu.php'); //entra a un programa
    } else {
        echo "Usuario o contrasena no valido";
    }
}
////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="container">
        <div class="text-center">
            <img src="recursos/logo.jpg" alt="Logo de la escuela" class="img-fluid">
        </div>
        <h2 class="text-center">Proyecto 46</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control custom-input" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control custom-input" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </form>
        Aun no tienes cuenta?<a href="registro.html">Registrate</a>
    </div>

    <!-- Incluye la biblioteca JavaScript de Bootstrap al final del cuerpo del documento para que los componentes de Bootstrap funcionen correctamente -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>