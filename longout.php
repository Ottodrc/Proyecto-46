<?php
require("session.php");
$_SESSION = array();
setcookie(session_name(),'',time()-56000);
session_destroy();
header("Location: login.php");
exit;
?>