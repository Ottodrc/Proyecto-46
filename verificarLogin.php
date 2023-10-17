<?php
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "usuarioinfo");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Sanitiza y recopila los datos del formulario (correo electrónico y contraseña)
$email = mysqli_real_escape_string($conexion, $_POST['usuario']);
$contrasena = $_POST['contrasena']; // No necesitas hash aquí, ya que solo estás verificando

// Realiza una consulta SQL para verificar las credenciales
$query = "SELECT * FROM datos WHERE email = '$email'";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $hashedContrasena = $fila['contrasena'];

    if (password_verify($contrasena, $hashedContrasena)) {
        // Las credenciales son válidas, establece la variable de sesión
        $_SESSION['email'] = $email;
        header("Location: perfil.php"); // Redirige al perfil del usuario
        exit;
    } else {
        // Las credenciales son incorrectas
        $_SESSION['error'] = "Credenciales incorrectas";
        header("Location: Login.html");
        exit;
    }
} else {
    // No se encontró un usuario con ese correo electrónico
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: Login.html");
    exit;
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
