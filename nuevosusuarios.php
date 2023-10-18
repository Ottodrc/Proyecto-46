<?php
require "bd.php";

$usuarioNuevo= $_POST["nuevousuario"];
$contrasenaNueva= $_POST["nuevapassword"];
$repitaContrasenaNueva= $_POST["repetir"];
$conexion= new mysqli($db_host, $db_user, $db_pass, "usuarios");
if(!$conexion)
{   
die("No hemos podido conectarnos a la base de datos:" . mysqli_connect_errno());
}

//VALIDO
$queryUsuario = "SELECT * FROM usuarios WHERE usuario = '$usuarioNuevo'";
   $resultadoNuevoUsuario = mysqli_query($conexion, $queryUsuario);
   

if (mysqli_num_rows($resultadoNuevoUsuario)>0){

    echo "Nombre de usuario existente";



 
}
elseif(mysqli_num_rows($resultadoNuevoUsuario) <1 && $contrasenaNueva==$repitaContrasenaNueva){
    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuarioNuevo', '$contrasenaNueva')";
    echo "Nuevo usuario creado correctamente.";
}

elseif ($contrasenaNueva!=$repitaContrasenaNueva){
    echo "Las contraseñas no coinciden";
}

?>
    <li><a href="login.php">Volver</a></li><br>
    <li><a href="longout.php">Salir</a></li>