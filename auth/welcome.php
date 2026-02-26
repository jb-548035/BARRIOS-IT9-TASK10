<?php

session_start();
$session_id = session_id();
// If session is not set, redirect to login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    <h1>WELCOME PAGE</h1>
    <p>
        Hi <?php echo $_SESSION['username']?>
    </p>

    <a href="logout.php">Logout</a>
</body>
<script>
    let phpSessionId = "<?php echo $session_id; ?>";
    sessionStorage.setItem("PHP_SESSION_ID" , phpSessionId);
    console.log("Session ID: ", phpSessionId);
</script>
</html>