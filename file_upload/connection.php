<?php 

$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "journal_system";
$port = "3308";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
?>