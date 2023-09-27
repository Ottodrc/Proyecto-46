<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    
    $db_usuario = "usuario_db";
    $db_contrasena = "contrasena_db";

  
    if ($usuario === $db_usuario && $contrasena === $db_contrasena) {
        header("Location: inicio.php");
        exit;
    } else {
        echo "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}
?>


