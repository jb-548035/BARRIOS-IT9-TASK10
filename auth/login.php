<?php

session_start();
$session_id = session_id();
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit();
}

$users = [
    "admin" => "1234", 
    "janna" => "5678", 
    "student1" => "pass123"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists AND password matches
    if (isset($users[$username]) && $users[$username] === $password ){
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
</head>
<body>
    <h2>LOGIN</h2>
    <form method="POST">
        Username: <input type="text" name="username" required> <br> <br>
        Password: <input type="password" name="password" required ><br><br>
        <button type="submit">Login</button>
    </form>
    <script>
        let phpSessionId = "<?php echo $session_id; ?>"
        sessionStorage.setItem("PHP_SESSION_ID", phpSessionId);
    </script>
</body>
</html>