<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="p-4 bg-light">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold">Stored PDF and Images</h2>
        <a href="fileupload.php" class="btn btn-outline-dark px-4">Upload New</a>
    </div>

    <div class="row g-4">
        <?php
        $sql = "SELECT * FROM uploads";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $isPdf = ($row['filetype'] == 'application/pdf');
            $data = base64_encode($row['filedata']);
            $fileId = $row['id']; 
            $mimeType = $row['filetype'];
            ?>
            
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm h-100">
                    <div class="preview-box bg-white" style="height: 180px; overflow: hidden; position: relative;">
                        <?php if ($isPdf): ?>
                            <iframe src="data:application/pdf;base64,<?php echo $data; ?>#toolbar=0" width="100%" height="100%" style="border:none; pointer-events: none;"></iframe>
                        <?php else: ?>
                            <img src="data:<?php echo $mimeType; ?>;base64,<?php echo $data; ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body p-3 d-flex flex-column">
                        <h6 class="text-truncate mb-1"><?php echo htmlspecialchars($row['filename']); ?></h6>
                        <p class="small text-muted mb-3"><?php echo $mimeType; ?></p>
                        
                        <div class="mt-auto d-grid gap-2 d-md-flex justify-content-md-between">
                            <button onclick="viewFile('<?php echo $data; ?>', '<?php echo $mimeType; ?>')" 
                                    class="btn btn-sm btn-outline-primary flex-grow-1">View Full</button>
                            
                            <a href="delete.php?id=<?php echo $fileId; ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Delete this file permanently?')">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>

<script>
function viewFile(base64Data, mimeType) {
    const byteCharacters = atob(base64Data);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);
    const file = new Blob([byteArray], { type: mimeType });
    const fileURL = URL.createObjectURL(file);
    window.open(fileURL, '_blank');
}
</script>
</body>
</html>