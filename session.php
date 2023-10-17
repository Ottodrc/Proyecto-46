<?php
session_start();
function verificar_sesion()
{
    if (!isset($_SESSION["usuario"]))
    {
        header("Location: login.php");
        exit();
    }
    
}
?>