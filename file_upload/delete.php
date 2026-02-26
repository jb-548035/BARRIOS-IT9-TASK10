<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sql = "DELETE FROM uploads WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: view.php?message=deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: view.php");
}
?>