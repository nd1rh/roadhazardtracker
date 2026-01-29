<?php
session_start();
require_once 'config.php';

// Protect page: only logged-in admins
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Get total number of admins
$stmtAdmin = $pdo->prepare("SELECT COUNT(*) AS total_admins FROM admins");
$stmtAdmin->execute();
$totalAdmins = $stmtAdmin->fetch(PDO::FETCH_ASSOC)['total_admins'];

// Get total number of hazards
$stmtHazard = $pdo->prepare("SELECT COUNT(*) AS total_hazards FROM hazards");
$stmtHazard->execute();
$totalHazards = $stmtHazard->fetch(PDO::FETCH_ASSOC)['total_hazards'];
?>

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

    <div class="container mt-5">
        <h2 class="mb-4">Dashboard</h2>

        <div class="row g-4">
            <!-- Total Admins -->
            <div class="col-md-6">
                <a href="admin_details.php" class="text-decoration-none">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title">Total Admins</h5>
                            <p class="card-text text-white display-4"><?= $totalAdmins ?></p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Hazard Reports -->
            <div class="col-md-6">
                <a href="reported_list.php" class="text-decoration-none">
                    <div class="card text-white bg-danger shadow">
                        <div class="card-body">
                            <h5 class="card-title">Total Hazard Reports</h5>
                            <p class="card-text text-white display-4"><?= $totalHazards ?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <p class="text-center mt-5 small">
            Road Alert Tracker © <?= date('Y') ?>
        </p>
    </div>

    <script>
        const toggleBtn = document.getElementById('darkModeToggle');
        const body = document.body;

        // Load saved preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggleBtn.textContent = '☀ Light Mode';
        }

        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                toggleBtn.textContent = '☀ Light Mode';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                toggleBtn.textContent = '🌙 Dark Mode';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>