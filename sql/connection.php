<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "hospital";
$port = "3308";
$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("connection failed: " . mysqli_connect_error());

}
echo "Connected Successfully!";
?>
