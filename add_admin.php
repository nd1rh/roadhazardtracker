<?php
session_start();
require_once 'config.php';

// Protect page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO admins (username, fullname, email, contact, address, password, created_at) 
                           VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$username, $fullname, $email, $contact, $address, $password]);

    $_SESSION['success'] = "Admin added successfully!";
    header("Location: admin_details.php");
    exit;
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Road Alert Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <img src="images/logo.jpeg" alt="Road Hazard Tracker" width="36" height="36" class="rounded">
                <span>Road Alert Tracker</span>
            </a>

            <!-- Collapse button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
                <a href="dashboard.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Dashboard
                </a>
                <a href="admin_details.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Admin Details
                </a>
                <a href="reported_list.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Reports
                </a>
                <button id="darkModeToggle" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    🌙 Dark Mode
                </button>
                <a href="admin_logout.php" class="btn btn-sm btn-outline-light mt-2 mt-lg-0 ms-2">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 500px;">
        <h3 class="mb-4">Add New Admin</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Contact</label>
                <input type="text" name="contact" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Add Admin</button>
        </form>
        <a href="admin_details.php" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>

</html>