<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título Aquí</title>
    <!-- Agregamos la referencia a Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Proceso de Registro</h1>
            <hr class="my-4">
            <p class="lead">
                <?php
                require "bd.php";

                $usuarioNuevo = $_POST["nuevousuario"];
                $contrasenaNueva = $_POST["password"];
                $repitaContrasenaNueva = $_POST["repetir"];
                $conexion = new mysqli($db_host, $db_user, $db_pass, "proyecto46s");
                if (!$conexion) {
                    die("No hemos podido conectarnos a la base de datos: " . mysqli_connect_errno());
                }

                // VALIDO
                $queryUsuario = "SELECT * FROM usuarios WHERE usuario = '$usuarioNuevo'";
                $resultadoNuevoUsuario = mysqli_query($conexion, $queryUsuario);

                if (mysqli_num_rows($resultadoNuevoUsuario) > 0) {
                    echo "Nombre de usuario existente";
                } elseif (mysqli_num_rows($resultadoNuevoUsuario) < 1 && $contrasenaNueva == $repitaContrasenaNueva) {
                    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuarioNuevo', '$contrasenaNueva')";
                    echo "Nuevo usuario creado correctamente.";
                } elseif ($contrasenaNueva != $repitaContrasenaNueva) {
                    echo "Las contraseñas no coinciden";
                }
                ?>
            </p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="login.php" class="btn btn-primary">Volver</a></li>
                <li class="list-inline-item"><a href="longout.php" class="btn btn-danger">Salir</a></li>
            </ul>
        </div>
    </div>

    <!-- Agregamos la referencia a Bootstrap JS (jQuery es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>