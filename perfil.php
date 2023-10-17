<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        #profile-container {
            width: 400px;
            height: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        #profile-picture {
            width: 150px;
            height: 150px;
            border: 2px solid #ccc;
            border-radius: 50%;
            overflow: hidden;
            margin: 15px auto 20px;
        }
        #profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #profile-details {
            margin-top: 10px;
        }
        #profile-details h2 {
            margin: 0;
        }
        #profile-details p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div id="profile-container">
        <div id="profile-picture">
            <img src="nachito.jpg" alt="Foto de perfil">
        </div>
        <div id="profile-details">
        <?php
session_start(); // Inicia la sesión para mostrar mensajes al usuario

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "usuarioinfo");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Paso 1: Recupera el correo electrónico almacenado en la variable de sesión
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    // Manejo de errores si la variable de sesión no está configurada
    $email = "No se encontró un correo electrónico en la sesión";
}

// Realiza una consulta SQL para obtener los datos del usuario actual
$query = "SELECT * FROM datos WHERE email = '$email'";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $nombreUsuario = $fila['nombre'];
    $dni = $fila['documento'];
    
    // Cierra el resultado
    mysqli_free_result($resultado);
} else {
    // Manejo de errores si no se encontraron datos
    $nombreUsuario = "No se encontraron datos";
    $dni = "No se encontraron datos";
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>

            
            <h2><?php echo $nombreUsuario; ?></h2>
            <p>Correo Electrónico: <?php echo $email; ?></p>
            <p>DNI: <?php echo $dni; ?></p>
        </div>
    </div>
</body>
</html>
