<?php 
session_start();

//Unset all session variation
$_SESSION = [];

//Destroy the session
session_destroy();

//Delete the session cookie
setcookie("PHPSESSID", "", time() - 3600, "/");

//Redirect 
header("Location: login.php");
exit();
?>