<?php
session_start(); // Inicia la sesión para mostrar mensajes al usuario

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "usuarioinfo");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Sanitiza y recopila los datos del formulario
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Almacena la contraseña de manera segura
$documento = mysqli_real_escape_string($conexion, $_POST['nDocumento']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);

// Configura la variable de sesión $_SESSION['email'] con el correo electrónico del usuario
$_SESSION['email'] = $email;

// Realiza una consulta SQL para insertar los datos en la tabla "datos"
$query = "INSERT INTO datos (contraseña, documento, email, nombre) 
          VALUES ('$contrasena', '$documento', '$email', '$nombre')";

if (mysqli_query($conexion, $query)) {
    $_SESSION['message'] = "Registro exitoso"; // Mensaje de éxito
    header("Location: menu.html"); // Redirige a la página de inicio
    exit;
} else {
    $_SESSION['error'] = "Error al registrar el usuario: " . mysqli_error($conexion); // Mensaje de error
    header("Location: registrarse.html"); // Redirige de nuevo al formulario de registro
    exit;
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>

