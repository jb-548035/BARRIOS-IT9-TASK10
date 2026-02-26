<?php
include 'connection.php';
$message = "";

if (isset($_POST['upload'])) {
    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $tempname = $_FILES['file']['tmp_name'];
    $filedata = addslashes(file_get_contents($tempname));

    $sql = "INSERT INTO uploads (filename, filetype, filedata) VALUES ('$filename', '$filetype', '$filedata')";
    if(mysqli_query($conn, $sql)) {
        $message = "Success! File uploaded safely.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Launch Pad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="upload-card p-5 text-center shadow-lg">
        <h2 class="mb-4"><i class="bi bi-rocket-takeoff"></i>LAUNCH PAD</h2>
        <p class="text-muted">Upload your PDFs or Images to the secure server.</p>
        
        <?php if($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
            <div class="upload-area mb-4" id="drop-zone">
                <input type="file" name="file" id="fileInput" hidden required>
                <div class="icon-box mb-2">📁</div>
                <p id="file-name">Drag & drop or <span class="text-primary">browse</span></p>
            </div>
            <button type="submit" name="upload" class="btn btn-primary w-100 py-2">Upload File</button>
        </form>
        <div class="mt-3">
            <a href="view.php" class="text-decoration-none small">View Gallery</a>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>