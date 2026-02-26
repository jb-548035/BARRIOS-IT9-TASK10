<?php
include "connection.php";

// --- DELETE FUNCTIONALITY ---
if (isset($_GET['delete'])) {
    $deleteId = mysqli_real_escape_with_string($conn, $_GET['delete']);
    $sql = "DELETE FROM patient WHERE id='$deleteId'";
    mysqli_query($conn, $sql);
    header("Location: " . $_SERVER['PHP_SELF'] . "?msg=deleted");
    exit;
}

// --- EDIT FUNCTIONALITY ---
$editId = $_GET['edit'] ?? '';
$name = '';
$address = '';
$contactnum = '';

if ($editId) {
    $editId = mysqli_real_escape_string($conn, $editId);
    $result_edit = mysqli_query($conn, "SELECT * FROM patient WHERE id='$editId'");
    if ($row_edit = mysqli_fetch_assoc($result_edit)) {
        $name = $row_edit['name'];
        $address = $row_edit['address'];
        $contactnum = $row_edit['contactnum'];
    }
}

// --- ADD OR UPDATE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);

    if (!empty($editId)) {
        $sql = "UPDATE patient SET name='$name', address='$address', contactnum='$contactnum' WHERE id='$editId'";
        mysqli_query($conn, $sql);
        $status = "updated";
    } else {
        $sql = "INSERT INTO patient (name, address, contactnum) VALUES ('$name', '$address', '$contactnum')";
        mysqli_query($conn, $sql);
        $status = "added";
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?msg=$status");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM patient");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .table thead { background-color: #0d6efd; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 mb-4">
            <div class="card p-4">
                <h3 class="mb-4 text-primary">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    <?php echo $editId ? 'Edit Patient' : 'Add New Patient'; ?>
                </h3>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Patient Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" value="<?php echo $name; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Patient Address</label>
                        <input type="text" name="address" class="form-control" placeholder="123 Street, City" value="<?php echo $address; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Contact Number</label>
                        <input type="text" name="contactnum" class="form-control" placeholder="0912 345 6789" value="<?php echo $contactnum; ?>" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <?php echo $editId ? '<i class="bi bi-check-circle me-1"></i> Update Patient' : '<i class="bi bi-plus-circle me-1"></i> Register Patient'; ?>
                        </button>
                        <?php if($editId): ?>
                            <a href="form.php" class="btn btn-light mt-2">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <?php if(isset($_GET['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Operation completed successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card overflow-hidden">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 text-dark">Patient Registry</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td class='ps-4'>#".$row['id']."</td>";
                                    echo "<td class='fw-bold'>".$row['name']."</td>";
                                    echo "<td>".$row['address']."</td>";
                                    echo "<td><span class='badge bg-light text-dark border'>".$row['contactnum']."</span></td>";
                                    echo "<td class='text-center'>
                                            <a href='?edit=".$row['id']."' class='btn btn-sm btn-outline-primary me-1'><i class='bi bi-pencil'></i></a>
                                            <a href='?delete=".$row['id']."' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'><i class='bi bi-trash'></i></a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No patients found in the database.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>